<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use App\services\ProjectService;
use App\services\UserService;
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

    public function store(Request $request){
        $userService = new UserService();
        if($userService->isAdminDept()){
            abort(403);
        }
        $upload = $this->uploadDocument($request,null);
        $documents = new Document([
            'description' => $request->description,
            'document_name' => $upload,
            'owner' => $request->owner,
            'set_home' => $request->set_home ? true : false,
            'upload_by' => auth()->user()->id,
        ]);

        $documents->save();
        $request->session()->flash('alert-success', 'Data was successful created!');
        return redirect('document');
    }

    public function update(Document $document, Request $request){
        $this->authorize('update');
        $userService = new UserService();
        if($userService->isAdminDept()){
            abort(403);
        }
        $url = url()->previous();
        if(!isset($request->isDocumentList)){
            $url = 'document';
            $documentUpload = $this->uploadDocument($request, $document);
            $document->document_name = $documentUpload;
        }
        $document->description = $request->description;
        $document->set_home = isset($request->set_home) ? true : false;
        $document->owner = $request->owner;
        $document->save();
        $request->session()->flash('alert-success', 'Data was successful updated!');
        return redirect($url);
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
        $data =  Document::where('id',$request->document_id)->first();
        $userService = new UserService();
        if(!($userService->isAdmin() || $userService->isViewer()) &
            auth()->user()->department != $data->owner){
            return 404;
        }
        return response()->file(storage_path('app/documents/').$data->document_name);
    }

    public function uploadDocument(Request $request, $existingDocument){
        $document_name = null;
        $dep = Department::where('id',$request->owner)->first();
        if($request->hasfile('document')) {
            $request->validate([
                'document' => 'required|mimes:doc,docx,pdf|max:2048'
            ]);

            if (isset($existingDocument)) {
                $this->deleteDocument($existingDocument);
            }

            $file = $request->file('document');
            $name = uniqid() . '_' . (isset($dep) ? $dep->name : 'All_Dept') . '_' . $file->getClientOriginalName();
            Storage::disk('local')->putFileAs('documents', $file, $name);
            $document_name = $name;
        }

        return $document_name ?: $existingDocument->document_name;
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

    private function deleteDocument($document){
        $existDocumentName = storage_path('app\\documents\\') . $document->document_name;
        if (File::exists($existDocumentName)) {
            File::delete($existDocumentName);
        }
    }
}
