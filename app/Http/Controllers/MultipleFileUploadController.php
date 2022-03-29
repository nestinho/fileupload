<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class MultipleFileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at','DESC')->paginate(30);
        return view('multiple.index',['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('multiple.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //You may validate your input request this way
        // $this->validate($request, [
        //     'file' => 'required | file | max : 20000'
        // ]);

        // Or this way
        // $request->validate([
        //     'file' => 'required | file| mimes : png, jpg, webp, jpeg, gif, pdf, docx, 
        //     ppt, xlsx,xps, odt,
        //     | max : 20000'
        // ]);

        $files = $request->file('file');
        foreach ($files as $file) {

         File::create([
            'title' => $file->getClientOriginalName(),
            'description' => '',
            'path' => $file->store('public/storage'),
            
        ]);
        // $file->save();
        }
        return redirect('/multiple')->with('success','Files were successfully uploaded!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //1. Find id (specific) file to delete
         $file = File::find($id);

         //2. Unset/delete it's path
         Storage::delete($file->path);
 
         //3. delete the file from storage
         $file->delete();
 
         //4. redirecting to a page after delet action is completed
         return redirect('multiple')->with('success','File has been deleted successfully!');
    }
}
