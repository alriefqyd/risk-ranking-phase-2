<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
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
        return response()->file(storage_path('app/documents/'.$request->dir.'/'. $request->category .'/'.$request->file));
    }

    public function uploadDocument(Request $request, $existingDocument, $project_name){
        $document_name = null;
        if($request->hasfile('document')) {
            $request->validate([
                'document' => 'required|mimes:doc,docx,pdf|max:10240'
            ]);


            $file = $request->file('document');
            $name = $request->file_category .'-' . $project_name . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $dir = 'documents/'.$project_name;
            Storage::disk('local')->putFileAs($dir, $file, $name);
            $document_name = $name;

            if (isset($existingDocument)) {
                $this->deleteDocument($existingDocument, $project_name);
            }
        }

        return $document_name ?? $existingDocument;
    }

    public function multipleUploadDocument($request, $documentRequests, $existingDocument, $project_name){
        $projectService = new ProjectService();
        $document_name = null;
        $documents = collect([]);
        if($documentRequests) {

            $allowedFileExtension = ['docx','doc','pdf','xlsx','csv','xlx'];

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
                foreach ($existingDocument as $k => $v){
                    if(isset($documentRequests[$k])) {
                        $this->deleteDocument($v, $project_name);
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

    private function deleteDocument($document, $path){
        $existDocumentName = storage_path('app\\documents\\') . $path .'\\' . $document;
        if (File::exists($existDocumentName)) {
            File::delete($existDocumentName);
        }
    }
}
