<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserRegisterResource;
use App\Repositories\UserRepository;

class UserRegisterController extends Controller
{
    /**
     * @api {post}/api/user/register
     * Faz o registro de um novo usuário no sistema
     * @param UserRegisterRequest $request
     * @return json
     */
    public function register(UserRegisterRequest $request) {
        $user = UserRepository::createUser($request);

        return new UserRegisterResource(['user' => $user]);
    }
}
