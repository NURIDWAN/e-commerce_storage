<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Intervention\Image\Facades\Image;



class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    function HandleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $finduser = User::where('google_id', $user->getId())->first();

        if ($finduser) {
            Auth::login($finduser);
            return redirect('dashboard');
        }else{
            $avatar_File = $user->getId() . ".JPG";
            $fileContent = file_get_contents($user->getAvatar());
            File::put(public_path("upload/user-images/$avatar_File"), $fileContent);


             User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'google_id' => $user->getId(),
                'password' => Hash::make('user_google'),
                'profile_photo_path' => $avatar_File,
            ]);


            return redirect('dashboard');
        }
    }


}
