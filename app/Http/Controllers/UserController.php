<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public  function UploadAvatar(Request $request)
    {
        $user = Auth::user();
        $path = public_path().'/images/avatars/';

        if ($user->avatar) {
            if (file_exists($path.$user->avatar)) {
                @unlink($path.$user->avatar);
            }
        }

        $image = $request->file('fileInput');
        $img = Image::make($image);
        $img->fit(100, 100);

        $imageName = time().$user->id.$image->getClientOriginalName();
        $img->save($path.$imageName, 60);

        $user->avatar = $imageName;
        $user->save();
        return url('/images/avatars/'.$imageName);
    }
}
