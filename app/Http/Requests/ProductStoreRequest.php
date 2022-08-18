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
            'category_ids' => 'required',
            'brand_id' => 'required',
            'code' => 'required',
            'quantity_total' => 'required|integer',
            'unit_price' => 'required_if:no_variant,on|nullable|numeric',
            'unit_special_price' => 'nullable|numeric',
            'name' => 'required',
            //'description' => 'required',
            'short_description' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_ids.required' => 'Odaberite kategoriju!',
            'code.required' => 'Unesite jedinstveni kod ručno ili pritisnite gumb <generiraj>',
            'quantity_total.required' => 'Unesite količinu ili stavite 0 za automatsko onemogućavanje prikaza proizvoda',
            'quantity_total.integer' => 'Količina mora biti cijeli broj',
            'name.required' => 'Unesite naziv proizvoda',
            //'description.required' => 'required',
            'short_description.required' => 'Unesite kratki opis proizvoda',
            'brand_id.required' => 'Proizvod mora sadržavati brand',
            'unit_price.required_if' => 'Cijena mora biti izražena',
            'unit_price.numeric' => 'Cijena mora biti izražena u brojkama',
            'unit_special_price.numeric' => 'Specijalna cijena mora biti izražena u brojkama',
        ];
    }
}
