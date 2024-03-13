<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItStaffRequest extends FormRequest
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
            "first_name" => "",
            "middle_name" => "",
            "last_name" => "",
            "username" => "",
            "password" => "",
            "office_id" => "",
            "categories" => "",
            "roles" => ""
        ];
    }
}
