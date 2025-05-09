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
        'image'       => 'nullable|image|max:2048',
        'hit'         => 'sometimes|boolean',
        'new'         => 'sometimes|boolean',
        'recommend'   => 'sometimes|boolean',
        'count'       => 'required|numeric|min:0',
    ];

    if ($this->routeIs('products.update')) {
        // unikālums, izņem šo pašu ierakstu
        $rules['code'] = "required|min:3|max:255|unique:products,code,{$this->route('product')->id}";
    }

    return $rules;
}


    public function messages (){
        return [
            'required' => 'Lauks :attribute ir obligāts, lūdzu aizpildijiet!',
            'min' => 'Laukam :attribute ir jāsatūr vismaz :min simbolus',
            'price.min'=>'Laukam cena, cenai ir jābūt lielākai par :min',
        ];
    }
}
