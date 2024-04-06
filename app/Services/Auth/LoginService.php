<?php
namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function checkLogin($request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return Auth::user();
        }

        return false;
    }
}
