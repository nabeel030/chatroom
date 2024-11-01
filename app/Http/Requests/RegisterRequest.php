<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
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
        return true; // Allow all users to register
    }
}