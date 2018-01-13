<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index(){
        return view('albums.index');
    }

    public function create(){
        return view('albums.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image|max:1999'
        ]);


        $filenameAppend = $request->file('cover_image')->getClientOriginalName();

        $filename = pathinfo($filenameAppend, PATHINFO_FILENAME);

        $extension = $request->file('cover_image')->getClientOriginalExtension();

        $fileToStore = $filename.'_'.time().'.'.$extension;

        $path = $request->file('cover_image')->storeAs('public/album_covers', $fileToStore);

       //Create album
        $album = new Album;
        $album->name = $request->input('name');

     }
}
