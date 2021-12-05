<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\CheckUserEmail;
use App\Rules\CheckUserPassword;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $emailRules = [
            'required',
            'email:rfc,dns',
            new CheckUserEmail($this->user)
        ];

        $passwordRules = [
            'required',
            new CheckUserPassword($this->user)
        ];

        return [
            'email'     => $emailRules,
            'password'  => $passwordRules,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'        => 'Email is required',
            'password.required'     => 'Password is required',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        //tenta procurar o usuário pelo email
        $this->user = User::where('email', $this->email)->first();

        $this->merge([
            'user'  => $this->user
        ]);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success'       => false,
                'error'         => $validator->errors()->all()[0],
            ], 402)
        );
    }
}
