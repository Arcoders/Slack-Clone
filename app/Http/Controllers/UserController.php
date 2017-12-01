<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public  function UploadAvatar(Request $request)
    {
        dd($request->image);
//        $img = Image::make($$request);
//        $img->fit(100, 100);
//        $img->save('foo/bar.jpg');
    }
}
