<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use App\Models\Setting;
use App\Models\TemporaryFile;
use App\Service\ProjectService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(){
        $userService = new UserService();
        $document = Document::with(['user','owners']);
        if($userService->isAdminDept()){
            $document = $document->where('owner', auth()->user()->department)
            ->orWhere('owner','*');
        }
        return view('document.index',[
            'documents' => $document->get()
        ]);
    }

    public function create(){
        $userService = new UserService();
        if($userService->isAdminDept()){
          abort(403);
        }
        $projectService = new ProjectService();
        return view('document.create',[
            'department' => $projectService->getDepartment(Department::TYPE['department'],null),
        ]);
    }

    public function show(Document $document){
        $this->authorize('update');
        $userService = new UserService();
        if(!($userService->isAdmin() || $userService->isViewer()) &
            auth()->user()->department != $document->owner){
            abort(403);
        }
        $projectService = new ProjectService();
        return view('document.edit',[
            'document' => $document,
            'department' => $projectService->getDepartment(Department::TYPE['department'],null),
        ]);
    }

    public function preview(Request $request)
    {
        try {
            $dir = urldecode($request->dir);
            $filePath = storage_path('app/documents/' . $dir . '/' . $request->category . '/' . $request->file);
            if (!file_exists($filePath)) {
                throw new \Exception('File not found.');
            }

            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            // Preview only if it's a PDF
            if ($extension === 'pdf') {
                return response()->file($filePath);
            }

            // For all other types, trigger download
            return response()->download($filePath);

        } catch (\Exception $e) {
            // Preserve tab state if error occurs
            if ($request->category == Setting::FOLDER_TYPE['assessment']) {
                $request->session()->flash('page-tab', 'assessment');
            }
            if ($request->category == Setting::FOLDER_TYPE['fel1']) {
                $request->session()->flash('page-tab', 'fel1');
            }
            if ($request->category == Setting::FOLDER_TYPE['fel2']) {
                $request->session()->flash('page-tab', 'fel2');
            }
            if ($request->category == Setting::FOLDER_TYPE['fel3']) {
                $request->session()->flash('page-tab', 'fel3');
            }
            if ($request->category == Setting::FOLDER_TYPE['bc']) {
                $request->session()->flash('page-tab', 'business-case');
            }

            $request->session()->flash('alert-error-download', $e->getMessage());
            return back();
        }
    }


    public function uploadDocument(Request $request,$file, $existingDocument, $project_name, $allowedFileExtension){
        $document_name = null;
        if($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check){
                $project_name = preg_replace("/\r|\n/", " ", $project_name);
                $document_name = $request->file_category .'-' . $project_name . '-' . uniqid() . '.' . $extension;
                $dir = 'documents/'.$project_name.'/'.$request->file_category;
                Storage::disk('local')->putFileAs($dir, $file, $document_name);
            }

            if(isset($existingDocument)) {
                $dirName = $project_name . '/' . $request->file_category;
                $this->deleteDocument($existingDocument, $dirName);
            }
        }

        return $document_name ?? $existingDocument;
    }

    public function multipleUploadDocument($request, $documentRequests, $existingDocument, $project_name,$allowedFileExtension){
        $projectService = new ProjectService();
        $document_name = null;
        $documents = collect([]);
        $project_name = preg_replace("/\r|\n/", " ", $project_name);

        if($documentRequests) {

            $files = $documentRequests;
            foreach ($files as $key => $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedFileExtension);
                if($check){
                    //$name = $request->file_category .'-' . $project_name . '-' . uniqid() . '.' . $extension;
                    $documents->put($key ,$filename);
                    $dir = 'documents/'.$project_name.'/'.$request->file_category;
                    Storage::disk('local')->putFileAs($dir, $file, $filename);
                }
            }

            if (isset($existingDocument)) {
                $dirName = $project_name . '/' . $request->file_category;
                foreach ($existingDocument as $k => $v){
                    if(isset($documentRequests[$k])) {
                        $this->deleteDocument($v, $dirName);
                    } else {
                        $documents->put($k,$v);
                    }
                }
            }
        }
        return $documents;
    }

    public function destroy(Document $document, Request $request){
        $this->authorize('delete');
        $userService = new UserService();
        if(!$userService->isAdmin() && !$userService->isViewer()){
            abort(403);
        }
        $this->deleteDocument($document);
        $document->delete();
        $request->session()->flash('alert-success', 'Data was successful deleted!');
        return redirect('/document');
    }

    /**
     * Function used to delete or remove document
     * @param $document
     * @param $path
     * @return void
     */
    private function deleteDocument($document, $path){
        $existDocumentName = storage_path('app/documents/') . $path .'/' . $document;
        if (File::exists($existDocumentName)) {
            File::delete($existDocumentName);
        }
    }

    public function store(Request $request){
        $arr = Setting::BUSINESS_CASE_ATTACHMENT;
        foreach ($arr as $k => $v) {
            if ($request->hasFile($k)) {
                $files = $request->file($k);
                $folder = $request->folder;

                if (is_array($files)) {
                    // Handle multiple files for preliminary_design
                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $filename = preg_replace('/[^A-Za-z0-9\-_.]/', '-', $filename);
                        $file->storeAs('documents/temp/' . $folder . '/' . $k, $filename);

                        TemporaryFile::create([
                            'file_name' => $filename,
                            'folder_name' => $folder,
                        ]);
                    }
                } else {
                    // Handle single file for other fields
                    $filename = $files->getClientOriginalName();
                    $files->storeAs('documents/temp/' . $folder . '/' . $k, $filename);

                    TemporaryFile::create([
                        'file_name' => $filename,
                        'folder_name' => $folder,
                    ]);
                }

                return $folder;
            }
        }
        return null;
    }

    public function cancel(Request $request)
    {
        // Retrieve the folder and type from the request
        $folder = $request->folder; // Main folder name
        $type = $request->type; // Subfolder (folder type) name

        // Construct the path to the folder_type directory
        $directoryPath = 'documents/temp/' . $folder . '/' . $type . '/';

        // Check if the directory exists
        if (Storage::exists($directoryPath)) {
            // If the type is 'preliminary_design', delete the specific file
            if ($type == 'preliminary_design') {

                $tempFileDb = TemporaryFile::where('folder_name', $folder)->where('file_name',$request->file_name)->first();
                // Delete the file associated with the temporary record
                Storage::delete($directoryPath . $tempFileDb->file_name);
                // Remove the record from the database
                $tempFileDb->delete();
            } else {
                $tempFileDb = TemporaryFile::where('folder_name', $folder)->first();
                // Get all files in the directory and delete them one by one
                $files = Storage::files($directoryPath);
                foreach ($files as $file) {
                    Storage::delete($file); // Delete each file individually
                }
                // After files are deleted, delete the directory (optional)
                Storage::deleteDirectory($directoryPath);
                // Remove the database record
                $tempFileDb->delete();

                return response()->json(['status' => 'success']);
            }
        }

        return response()->json(['error' => 'Folder type directory not found.'], 404);
    }


    public function update(Request $request){
        // Validate the request
        $request->validate([
            'file_id' => 'required|string', // File identifier
            'folder' => 'required|string', // Folder location
            'file' => 'required|file', // Updated file
        ]);

        $fileId = $request->input('file_id'); // Get file ID
        $folder = $request->input('folder'); // Get folder
        $file = $request->file('file'); // Get new file

        // Locate the existing file
        $existingFilePath = "documents/temp/{$folder}/{$fileId}";

        if (!Storage::exists($existingFilePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        // Replace the existing file
        Storage::putFileAs("documents/temp/{$folder}", $file, $fileId);

        return response()->json(['status' => 'File updated successfully.']);
    }

}
