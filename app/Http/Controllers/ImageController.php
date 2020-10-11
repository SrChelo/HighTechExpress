<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Image;

class ImageController extends Controller
{
    public function fileUpload(Request $req){
        $req->validate([
            'file'=>'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        $imageModel = new Image;
        if($req->file()){
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('images',$fileName,'public');

            $imageModel->name = $fileName;
            $imageModel->user_id = Auth::user()->id;
            $imageModel->image_path = '/storage/'.$filePath;
            $imageModel->save();
            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
    }
}
