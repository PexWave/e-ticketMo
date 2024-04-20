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
            'user_id' => "",
            'client_type_id' => "",
            'ticket_status' => "",
            'actual_response' => "",
            'actual_resolve' => "",
            'modified_date' => "",
            'reference_date' => "",
            'remarks' => "",
            'task_type_id' => "",
            'assigned_to' => "",
            'transferred_to' => "",
            'transferred_by' => "",
            'new_resolve' => "",
            'transfer_ticket_date' => "",
            'ticket_number'=> "",

        ];
    }
}
