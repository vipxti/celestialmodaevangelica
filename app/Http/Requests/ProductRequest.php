<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        dd($this->request);

        $rules = [
            'cd_ean' => 'required',
            'cd_sku' => 'required',
            'nm_produto' => 'required',
            'ds_produto' => 'required',
            'vl_produto' => 'required',
            'qt_produto' => 'required',
            'cd_categoria' => 'required',
            'cd_subcategoria' => 'required',
            'status' => 'required',
            'images.*' => 'required|image|mimes:jpeg,bmp,png'
        ];

        //dd($rules);

        return $rules;

    }
}
