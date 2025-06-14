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
    $rules = [
        'code'        => 'required|min:3|max:255|unique:products,code',
        'name'        => 'required|min:3|max:255',
        'description' => 'required|min:5',
        'price'       => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'hit'         => 'sometimes|boolean',
        'new'         => 'sometimes|boolean',
        'recommend'   => 'sometimes|boolean',
        'count'       => 'required|numeric|min:0',
    ];

   
    if ($this->routeIs('admin.products.update')) {
        $rules['code'] = "required|min:3|max:255|unique:products,code,{$this->route('product')->id}";
    }

    return $rules;
}


public function messages()
{
    return [
        'required' => 'Lauks :attribute ir obligāts, lūdzu aizpildiet!',
        'min' => 'Laukam :attribute jābūt vismaz :min simbolus garam.',
        'price.min' => 'Laukam cena jābūt lielākai par :min.',
    ];
}

public function attributes()
{
    return [
        'code' => 'kods',
        'name' => 'nosaukums',
        'description' => 'apraksts',
        'price' => 'cena',
        'category_id' => 'kategorija',
        'count' => 'daudzums',
        'image' => 'attēls',
    ];
}
}