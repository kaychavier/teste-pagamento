<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;
use Inertia\Response;
use Inertia\ResponseFactory;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(private readonly UserRepository $repository)
    {
        $this->middleware('guest');
    }

    protected function validator(array $data): ValidationValidator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function showRegistrationForm(): ResponseFactory | Response
    {
        return inertia('Auth/Register');
    }

    protected function create(array $data): User
    {
        return $this->repository->createByRole($data, 'operador');
    }
}
