<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Inertia\Response;
use Inertia\ResponseFactory;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm(): ResponseFactory | Response
    {
        return inertia('Auth/Passwords/Email');
    }
}
