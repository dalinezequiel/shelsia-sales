<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'barcode' => 'required',
            'description' => 'required',
            'category' => 'required|integer',
            'unit' => 'required|integer',
            'supplier' => 'required|integer',

            'validity' => 'required',

            'purchase_price' => 'required|numeric|min:1',
            'sale_price' => 'required|numeric|min:1',

            'minimum_stock' => 'required|numeric|min:1',
            'maximum_stock' => 'required|numeric|min:1',
            'available_stock' => 'required|numeric|min:1'
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
