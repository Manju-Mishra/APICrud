<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\image;

class Multipleimage extends Controller
{
    public function image()
    {
        $data=image::all();
        $images=explode('|',$data);
        return view('multipleimage.image',compact('data'));
    }

    public function sendimage(Request $req)
    {
        $val = $req->validate([
            'image' => 'required',
        ]);
        if ($val) {
            if($req->has('image'))
            {
                foreach ($req->file('image') as $file)
                 {
                    $file1=$req->file('image');
                    $dest=public_path('/uploads');
                    $filename="Image-".rand()."-".time().".".$file->extension();
                    $file->move(public_path('/uploads'),$filename);
                    // $filename=$file->getClientOriginalName();
                    // $file->move(public_path().'/uploads/', $filename); 
                    $images[]= $filename;
                }
            }
           // return $images;
        
            $data=image::insert([
                'image'=>implode('|',$images),
            ]);
            if ($data) {
                return back()->with('msg', 'Image Uploaded');
            } else
                return back()->with('msg', 'Image not Uploaded');
        }
    }
}
