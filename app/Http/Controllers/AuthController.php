<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $fecha = Carbon::now();
        $userGoolge = Socialite::driver('google')->user();

        $userExists = User::Where('email', $userGoolge->email)->first();
        if ($userExists) {
            $user = User::find($userExists->id);
            if ($user != null) {
                $user->name                 = $userGoolge->name;
                $user->google_id            = $userGoolge->id;
                $user->google_token         = $userGoolge->token;
                $user->profile_photo_path   = $userGoolge->avatar;
                $user->save();
            }
        }else{

            $user = User::updateOrCreate([
                'google_id' => $userGoolge->id,
            ], [
                'name' => $userGoolge->name,
                'email' => $userGoolge->email,
                'email_verified_at' => $fecha,
                'google_id' => $userGoolge->id,
                'google_token' => $userGoolge->token,
                'profile_photo_path' =>$userGoolge->avatar,
            ]);
        }




        Auth::login($user);

        return redirect('/dashboard');
    }
}
