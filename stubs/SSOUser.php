<?php

namespace App\Actions\CustomD;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as GoogleUser;

class SSOUser
{
    public function execute(GoogleUser $user)
    {
        Auth::login(
            $this->getUser($user)
        );

        $authedUser = Auth::user();

        if (request()->expectsJson()) {
            return $this->authOnSPA($authedUser) ?? response()->json($authedUser, 200);
        }

        return redirect("/");
    }

    protected function getUser(GoogleUser $user)
    {
        return User::where('email', $user->getEmail())->first() ?? $this->createUser($user);
    }


    protected function createUser(GoogleUser $user): User
    {
        $user = User::create([
            'name'     => $user->getName(),
            'email'    => $user->getEmail(),
            'password' => Hash::make("Cd-{$user->getId()}@#!"),
        ]);

        //Add your user to roles etc here

        return $user;
    }

    protected function authOnSPA(User $user)
    {
        //Sanctum should be fine,

        //Passport would be more $user->getToken() ...
        //return response()->json(xxx);

        return null;
    }
}
