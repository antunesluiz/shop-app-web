<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserLoginResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function login(UserLoginRequest $request) {
        $user = UserRepository::login($request);

        $data = [
            'success'   => false,
            'user'      => null,
        ];

        if ($user) {
            $data = [
                'success'   => true,
                'user'      => $user,
            ];
        }

        return new UserLoginResource($data);
    }
}
