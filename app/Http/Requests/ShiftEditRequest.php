<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required',
            'user' => 'required|exists:users,id',
            'company' => 'required|exists:companies,id',
            'hours' => 'required|numeric',
            'rate_per_hour' => 'required|numeric',
            'taxable' => 'required|bool',
            'status' => 'required|exists:statuses,id',
            'shift_type' => 'required|exists:shift_types,id'
        ];
    }
}
