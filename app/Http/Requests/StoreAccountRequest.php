<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'account_plan' => 'required',
            'description' => 'required',
            'category' => 'required',
            'payment_method_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'period_id' => 'required|integer',

            'due_date' => 'required',
            'date_of_issue' => 'required',
            'amount' => 'required|numeric|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Este campo é obrigatório.',
            'min' => 'Este campo deve ter no mínimo :min.'
        ];
    }
}
