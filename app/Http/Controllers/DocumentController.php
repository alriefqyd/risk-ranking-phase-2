<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use App\Models\Setting;
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

    public function preview(Request $request){
        try {
            $dir = urldecode($request->dir);
            return response()->file(storage_path('app/documents/'.$dir.'/'. $request->category .'/'.$request->file));
        } catch (\Exception $e){
            if($request->category == Setting::FOLDER_TYPE['assessment']){
                $request->session()->flash('page-tab','assessment');
            }
            if($request->category == Setting::FOLDER_TYPE['fel1']){
                $request->session()->flash('page-tab','fel1');
            }
            if($request->category == Setting::FOLDER_TYPE['fel2']){
                $request->session()->flash('page-tab','fel2');
            }
            if($request->category == Setting::FOLDER_TYPE['fel3']){
                $request->session()->flash('page-tab','fel3');
            }
            if($request->category == Setting::FOLDER_TYPE['bc']){
                $request->session()->flash('page-tab','business-case');
            }

            $request->session()->flash('alert-error-download', $e->getMessage());
            return $e->getMessage();
        }
    }

    public function uploadDocument(Request $request,$file, $existingDocument, $project_name, $allowedFileExtension){
        $document_name = null;
        if($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);
            if($check){
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

        if($documentRequests) {

            $files = $documentRequests;
            foreach ($files as $key => $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedFileExtension);
                if($check){
                    $name = $request->file_category .'-' . $project_name . '-' . uniqid() . '.' . $extension;
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
}
