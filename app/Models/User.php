<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'remember_token',
    ];

    protected $table = 'user';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    static public function generate_token() {
        $token = str_replace(' ', '-', Hash::make(rand() . time() . rand()));
        $token = str_replace(' ', '.', $token);

        return preg_replace('/[^A-Za-z0-9\-]/', '', $token);
    }
}
