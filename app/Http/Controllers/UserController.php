<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class UserController extends Controller
{
    public  function UploadAvatar(Request $request)
    {
        $path = public_path().'images/avatars/';
        $img = Image::make($request->image);
        $img->fit(100, 100);
        $img->save(public_path().'images/avatars/');
    }
}
