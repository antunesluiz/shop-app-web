<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserRegisterResource;
use App\Models\User;
use App\Repositories\UserRepository;

class UserRegisterController extends Controller
{
    public function register(UserRegisterRequest $request) {
        $user = UserRepository::createUser($request);

        return new UserRegisterResource(['user' => $user]);
    }
}
