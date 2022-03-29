<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at','DESC')->paginate(30);
        return view('file.index',['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.create');
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
        $request->validate([
            'file' => 'required | file | max : 20000'
        ]);

        $upload = $request->file('file');
        $path = $upload->store('public/storage');
        $file = File::create([
            'title' => $upload->getClientOriginalName(),
            'description' => '',
            'path' => $path
        ]);
        $file->save();

        return redirect('/file')->with('success','File was successfully uploaded!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::find($id);
        return Storage::download($file->path, $file->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::find($id);
        $data = array(
            'title' => $file->title,
            'path' => $file->path,
        );
        Mail::send('email.attachement', $data, function($message) use ($file){
            $message->to('cosmasp59@gmail.com', 'Cosmas Paulo')->subject('Laravel Email File Attachement Tutorial.');
            $message->attach(storage_path('app/'.$file->path));
            $message->from('nestory2008@gmail.com', 'Nestory Sylivester');
        });

        return redirect('/file')->with('success','File attachement has been sent via an email!');
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
        return redirect('file')->with('success','File has been deleted successfully!');
    }
}
