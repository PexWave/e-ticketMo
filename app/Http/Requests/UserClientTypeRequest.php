<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserClientTypeRequest extends FormRequest
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
            "user_info.first_name" => "required|string",
            "user_info.middle_name" => "nullable|string",
            "user_info.last_name" => "required|string",
            "user_info.username" => "required",
            "user_info.password" => "required",
            "user_info.office_id" => "required|integer|exists:offices,id",
            "client_type" => "",
        ];
    }
}
