<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        return [
            // MODEL => Product
            'category_ids' => 'required',
            'variant_ids' => 'required',
            'code' => 'required',
            'enabled' => 'required',
            
            // MODEL => ProductTranslation
            'name' => 'required',
            'drescription' => 'required',
            'short_description' => 'required',
        ];
    }
}
