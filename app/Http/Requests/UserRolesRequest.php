<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRolesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "max:150"],
            "last_name" => ["required", "max:150"],
            "email" => ["required", "max:200", "email:rfc"],
            "role_user" => ["required"]
        ];
    }
}
