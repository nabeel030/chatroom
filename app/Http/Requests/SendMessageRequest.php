<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class SendMessageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'message' => 'required|string|max:255',
            'attachment' => 'nullable|file|max:20480', // max size of 20MB
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
        return true; // Allow all users to send messages (you can adjust this as needed)
    }
}
