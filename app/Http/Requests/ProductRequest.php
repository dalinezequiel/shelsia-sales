<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_category_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'supplier_id' => 'required|integer',

            'validity' => 'required',
            'location' => 'required|unique:products',
            'image' => 'unique:products',

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
            'min' => 'Este campo deve ter no mínimo :min.',
            'unique' => 'Já existe.'
        ];
    }
}
