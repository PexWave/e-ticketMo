<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExtensionTimeRequest extends FormRequest
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
            'ticket_id' => "",
            'request_extension_resolve_time' => "",
            'request_extension_response_time' => "",
            'approved_by' => "",
            'approved_data' => "",
            'requested_by' => "",
            'requested_date' => "",
            'reason' => "",
            'extension_status' => "Pending"
        ];
    }
}
