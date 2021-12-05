<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this['user'];
        $user['token'] = $user['remember_token'];
        $user['firstName'] = $user['first_name'];
        $user['lastName'] = $user['last_name'];

        return [
            'success'   => true,
            'user'      => $user
        ];
    }
}
