<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required|string|min:3'],
            'email' => ['required|email'],
            'message' => ['required|string|min:10'],
            'phone' => ['required|string|min:10'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
