<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {
    public static function createUser($userData) {
       $user = new User();

       $user->email = $userData->email;
       $user->password = Hash::make($userData->password);
       $user->remember_token = $userData->token;

       $user->save();
       
       return $user;
    }

    public static function completeProfile($data) {
        $user = $data->user;

        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->phone = $data->phone;
        $user->address = $data->address;

        $user->save();

        return $user;
    }
}