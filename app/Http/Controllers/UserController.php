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
            $file =  substr($user->avatar, strrpos($user->avatar, '/') + 1);
            if (file_exists($path.$file)) {
                @unlink($path.$file);
            }
        }

        $image = $request->file('fileInput');
        $img = Image::make($image);
        $img->fit(100, 100);

        $imageName = time().$user->id.$image->getClientOriginalName();
        $img->save($path.$imageName, 60);

        $user->avatar = url('/images/avatars/'.$imageName);
        $user->save();
        return $user->avatar;
    }
}
