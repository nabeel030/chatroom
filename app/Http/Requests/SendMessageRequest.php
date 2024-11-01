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
            'message' => 'nullable|string|max:255|required_without:attachment',
            'attachment' => 'nullable|file|required_without:message',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, response()->json([
            'error' => 'Validation failed',
            'messages' => $validator->errors(),
        ], 422))); 
    }

    public function authorize()
    {
        return true; 
    }
}
