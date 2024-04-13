<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssigningTicketRequest extends FormRequest
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
            'category_id' => 'required',
            'client_type' => 'required',
            'difficulty' => 'required',
            'importance' => 'required',
            'reference_date' => 'required',
            'task' => 'required',
            'task_type_id' => 'required',
            'ticket_id' => 'required',
            'ticket_status' => 'required',
            'urgency' => 'required',
            'user_client_type_id' => 'required'
        ];
    }
}
