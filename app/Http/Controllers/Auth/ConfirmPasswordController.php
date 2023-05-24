<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Inertia\Response;
use Inertia\ResponseFactory;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showConfirmForm(): ResponseFactory | Response
    {
        return inertia('Auth/Passwords/Confirm');
    }
}
