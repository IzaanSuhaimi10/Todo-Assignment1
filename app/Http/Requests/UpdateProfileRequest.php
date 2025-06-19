<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
{
    return true;
}

public function rules()
{
    return [
        'nickname' => ['nullable', 'string', 'max:50'],
        'avatar' => ['nullable', 'image', 'max:2048'],
        'phone' => ['nullable', 'string', 'max:20'],
        'city' => ['nullable', 'string', 'max:100'],
        'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    ];
}
}
