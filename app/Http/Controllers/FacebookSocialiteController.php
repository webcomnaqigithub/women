<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookSocialiteController extends Controller
{
    public function redirectToFB()
    { 
        return Socialite::driver('facebook')->redirect();
    }
 
    public function handleCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('social_id', $user->id)->first();
             if($finduser){
                 Auth::login($finduser);
                return redirect('/');
            }else{
                 $newUser = User::create([
                     'name' => $user->name,
                     'social_id'=> $user->id,
                     'social_type'=> 'facebook',
                     'avatar'=>$user->avatar,
                     'password' => encrypt('my-facebook')
                ]);
                 Auth::login($newUser);
                return redirect('/');
            }
        } catch (Exception $e) {
             dd($e->getMessage());
        }
    }
}
