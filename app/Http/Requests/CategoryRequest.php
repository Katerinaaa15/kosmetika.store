<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules=[
            'code'=>'required |min:3|max:255',
            'name'=>'required |min:3|max:255',
            'description'=>'required |min:5',
        ];
        if($this->route()->named('admin.categories.store')){
            $rules['code'] .= '|unique:categories,code';

        }
        return $rules;
    }

    public function messages (){
        return [
            'required' => 'Lauks :attribute ir obligāts, lūdzu aizpildijiet!',
            'min' => 'Laukam :attribute ir jāsatūr vismaz :min simbolus',
        ];
    }
}
