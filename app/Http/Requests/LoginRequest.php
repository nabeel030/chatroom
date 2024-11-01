<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Customize the error response
        throw (new ValidationException($validator, response()->json([
            'error' => 'Validation failed',
            'messages' => $validator->errors(),
        ], 422))); // HTTP status code for Unprocessable Entity
    }

    public function authorize()
    {
        return true; // Allow all users to log in
    }
}
