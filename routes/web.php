<?php

use App\Actions\CustomD\SSOUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::group(['middleware' => ['web']], function () {
    Route::get('cd/oauth/redirect', function () {
        return Socialite::driver('google')
         ->with(['hd' => 'customd.com'])
         ->redirect();
    });

    Route::get('cd/oauth/callback', function () {
        $user = Socialite::driver('google')->user();
        resolve(SSOUser::class)->execute($user);
    });
});

Route::group(['middleware' => ['api']], function () {
    Route::post('api/cd/oauth/tokensignin', function (Request $request) {
        $user = Socialite::Driver('google')->userFromToken($request->token);
        resolve(SSOUser::class)->execute($user, true);
    });
});
