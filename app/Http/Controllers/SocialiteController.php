<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialiteController extends Controller
{
    // GITHUB
    public function RedirectGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function CallbackGithub()
    {
        $gituser = Socialite::driver('github')->user();
        // create a new user in database
        $user = User::firstOrCreate(
            [
                'provider_id' => $gituser->getId()
            ],
            [
                'email' => $gituser->getEmail(),
                'name' => $gituser->getName()
            ]
        );
        auth()->login($user , true);
        // $user->token
        return redirect('dashboard');
    }
    // GOOGLE AUTH
    public function RedirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function CallbackGoogle()
    {
        $googleuser = Socialite::driver('google')->user();
        //create a new user in database
        $user = User::firstOrCreate(
            [
                'provider_id' => $googleuser->id
            ],
            [
                'email' => $googleuser->email,
                'name' => $googleuser->name
            ]
        );
        auth()->login($user , true);
        // $user->token
        return redirect('dashboard');
    }
}
