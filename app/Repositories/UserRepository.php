<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {
    public static function createUser($userData) {
       $user = new User();

       $user->first_name = $userData->first_name;
       $user->last_name = $userData->last_name;
       $user->email = $userData->email;
       $user->phone = $userData->phone;
       $user->password = Hash::make($userData->password);
       $user->remember_token = $userData->token;

       $user->save();
       
       return $user;
    }
}