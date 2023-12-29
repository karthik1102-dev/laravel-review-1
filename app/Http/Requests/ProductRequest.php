<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {

        // $request['date'] = "test";
        return [
            'product' => 'required|max:255',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'A nice title is required for the product.',
            'price.required' => 'Please add price for the product.',
        ];
    }
}
