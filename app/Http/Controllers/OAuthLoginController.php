<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;

class OAuthLoginController extends Controller
{
    public function getGoogleAuth($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::firstOrNew(['email' => $googleUser->email]);
        if (!$user->exists) {
            // $user['name'] = $googleUser->getNickname() ?? $googleUser->getName() ?? $googleUser->getNick();
            // $user['email'] = $googleUser->email;
            // $user['verified'] = 1;
            // $user['google_id'] = $googleUser->getId();
            // $user['google_name'] = $googleUser->getNickname() ?? $googleUser->getName() ?? $googleUser->getNick();
            // $user->save();
            
            $newuser = new User;
            $newuser->name = $googleUser->getName();
            $newuser->email = $googleUser->getEmail();
            $newuser->save();
            
            Auth::login($newuser);
            return redirect('/');
            
        }
        Auth::login($user);
        // return redirect()->route('top');
        return redirect('/');
    }
}
