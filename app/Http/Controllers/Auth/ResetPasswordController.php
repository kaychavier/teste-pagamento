<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Inertia\Response;
use Inertia\ResponseFactory;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request): ResponseFactory | Response
    {
        $token = $request->route()->parameter('token');
        return inertia('Auth/Passwords/Reset', ['token' => $token, 'email' => $request->email]);
    }
}
