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
            'code' => 'required',
            'quantity_total' => 'required',
            'name' => 'required',
            //'description' => 'required',
            'short_description' => 'required',
            //'brand' => 'required',
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
            'name.required' => 'Unesite naziv proizvoda',
            //'description.required' => 'required',
            'short_description.required' => 'Unesite kratki opis proizvoda',
            'brand.required' => 'Odaberite brand',
        ];
    }
}
