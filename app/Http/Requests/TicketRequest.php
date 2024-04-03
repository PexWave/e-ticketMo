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
            'urgency' => "",
            'importance' => "",
            'user_id' => "",
            'ticket_status' => "",
            'actual_response' => "",
            'actual_resolve' => "",
            'modified_date' => "",
            'reference_date' => "",
            'remarks' => "",
            'task_type_id' => "",
        ];
    }
}
