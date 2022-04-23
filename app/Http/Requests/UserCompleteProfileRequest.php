<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserCompleteProfileRequest extends FormRequest
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
        return [
            'id'            => 'required',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone'         => 'required|unique:user|size:11',
            'address'       => 'required',
            'token'         => 'required',
            'user'          => 'required'
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
            'id.required'           => 'id is required',
            'first_name.required'   => 'First name is required',
            'last_name.required'    => 'Last name is required',
            'phone.required'        => 'Phone is required',
            'phone.unique'          => 'Phone should be unique',
            'address.required'      => 'Address is required',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $user = User::where('id', $this->id)->where('remember_token', $this->token)->first();

        $this->merge([
            'user' => $user,
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
                'error_code'    => 402
            ], 402)
        );
    }
}
