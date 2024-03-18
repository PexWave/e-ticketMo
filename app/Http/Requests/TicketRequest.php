<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'user_id' => "required",
            'ticket_status' => "required",
            'actual_response' => "required",
            'actual_resolve' => "required",
            'modified_date' => "required",
            'reference_date' => "required",
            'remarks' => "required",
            'task_type_id' => "required",
        ];
    }
}
