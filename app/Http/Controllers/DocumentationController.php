<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use App\Models\DocumentFile;
use App\Models\User;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function dashboard(){

        $mytotalpost = Documentation::where('user_id', Auth::user()->id)->count();
        $mytotalpublicpost = Documentation::where('user_id', Auth::user()->id)->where('status', 'public')->count();
        $mytotalprivatepost = Documentation::where('user_id', Auth::user()->id)->where('status', 'private')->count();

        return view('admin.dashboard.dashboard', compact('mytotalpost', 'mytotalpublicpost', 'mytotalprivatepost'));

     }

    public function index()
    {

        $alldocuments = Documentation::with('user')->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.documents.index', compact('alldocuments', ));
    }

    public function allDocument()
    {

        $alldocuments = Documentation::whereHas('user', function($query){
            $query->where('role', 'user');
        })->where('status', 'public')->orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.documents.allDocument', compact('alldocuments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'topic' => ['required'],
            'category' => ['nullable'],
            'source' => ['nullable'],
            'description' => ['required'],
            'status' => ['required'],
            'files' => ['nullable'],
            'is_approved' => ['required']
        ]);

        // Initialize the data array
        $data = [
            'topic' => $request->topic,
            'category' => $request->category,
            'source' => $request->source,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'is_approved' => $request->is_approved
        ];

        $document = Documentation::create($data);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = 'document' . '-' . rand() . '.' . $ext;
                $file->move(public_path('uploads'), $fileName);

                DocumentFile::create([
                    'files' => 'uploads/' . $fileName,
                    'documentation_id' => $document->id

                ]);
            }
        }

        toastr()->success('Data has been saved successfully!');

        return redirect()->route('admin.documents.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $item = Documentation::with('files')->findOrFail($id);

        if ($item->user_id !== Auth::user()->id && $item->status === 'private') {
            toastr()->error('Unauthorized');
            return redirect()->back();
        }

        return view('admin.documents.show', compact('item'));

    }

    public function publicDocumentShow(string $id){

        $item = Documentation::with('files')->findOrFail($id);

        if ($item->user_id !== Auth::user()->id && $item->status === 'private') {
            toastr()->error('Unauthorized');
            return redirect()->back();
        }

        return view('admin.documents.publicDocumentShow', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $document = Documentation::findOrFail($id);

        // if ($document->user_id !== Auth::user()->id) {
        //     toastr()->error('You Can Not Edit Other Documents');
        //     return redirect()->back();
        // }

        return view('admin.documents.edit', compact('document'));
    }

    public function publicDocumentEdit(string $id){
        $document = Documentation::findOrFail($id);

        // if ($document->user_id !== Auth::user()->id) {
        //     toastr()->error('You Can Not Edit Other Documents');
        //     return redirect()->back();
        // }

        return view('admin.documents.publicdocumentedit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the documentation record
        $document = Documentation::findOrFail($id);

        // Check if the authenticated user owns the document
        // if ($document->user_id !== Auth::user()->id) {
        //     toastr()->error('You cannot edit other users\' documents.');
        //     return redirect()->back();
        // }

        // Validate the request
        $request->validate([
            'topic' => ['required'],
            'category' => ['nullable'],
            'source' => ['nullable'],
            'description' => ['required'],
            'status' => ['required'],
            'files.*' => ['nullable', 'file'],
            'is_approved' => ['required']
        ]);


        $data = [
            'topic' => $request->topic,
            'category' => $request->category,
            'source' => $request->source,
            'description' => $request->description,
            'status' => $request->status,
            'is_approved' => $request->is_approved
        ];

        $document->update($data);

        if ($request->hasFile('files')) {

            foreach ($document->files as $existingFile) {

                if (File::exists(public_path($existingFile->files))) {
                    File::delete(public_path($existingFile->files));
                }

                $existingFile->delete();
            }

            foreach ($request->file('files') as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = 'document-' . rand() . '.' . $ext;
                $file->move(public_path('uploads'), $fileName);

                $document->files()->create([
                    'files' => 'uploads/' . $fileName,
                ]);
            }
        }

        toastr()->success('Data has been updated successfully!');
        return redirect()->route('admin.documents.index');
    }

    public function publicDocumentUpdate(Request $request, String $id){
          // Find the documentation record
        $document = Documentation::findOrFail($id);

        // Check if the authenticated user owns the document
        // if ($document->user_id !== Auth::user()->id) {
        //     toastr()->error('You cannot edit other users\' documents.');
        //     return redirect()->back();
        // }

        // Validate the request
        $request->validate([
            'topic' => ['required'],
            'category' => ['nullable'],
            'source' => ['nullable'],
            'description' => ['required'],
            'files.*' => ['nullable', 'file'],
        ]);


        $data = [
            'topic' => $request->topic,
            'category' => $request->category,
            'source' => $request->source,
            'description' => $request->description,
            'is_approved' => $request->is_approved,
        ];

        $document->update($data);

        if ($request->hasFile('files')) {

            foreach ($document->files as $existingFile) {

                if (File::exists(public_path($existingFile->files))) {
                    File::delete(public_path($existingFile->files));
                }

                $existingFile->delete();
            }

            foreach ($request->file('files') as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = 'document-' . rand() . '.' . $ext;
                $file->move(public_path('uploads'), $fileName);

                $document->files()->create([
                    'files' => 'uploads/' . $fileName,
                ]);
            }
        }

        toastr()->success('Data has been updated successfully!');
        return redirect()->route('admin.all.document');
    }


    public function destroy(string $id)
    {
        $document = Documentation::findOrFail($id);

        // if ($document->user_id !== Auth::user()->id) {
        //     toastr()->error('You Can Not Delete Other Documents');
        //     return redirect()->back();
        // }

        foreach ($document->files as $existingFile) {

            if (File::exists(public_path($existingFile->files))) {
                File::delete(public_path($existingFile->files));
            }
            $existingFile->delete();
        }

        Documentation::findOrFail($id)->delete();

        toastr()->success('Data has been deleted successfully!');

        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }
}
