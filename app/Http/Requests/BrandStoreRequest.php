<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
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
            'name' => 'required|max:191|min:2',
            'brand_image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Popunite naziv branda!',
            'name.min' => 'Naziv mora sadržavati najmanje 2 znaka',
            'brand_image.max' => 'Slika mora imati manje od 10000..',
            'brand_image.mimes' => 'Slika mora biti ponuđenog formata: [jpeg, jpg, png, gif]',
        ];
    }
}
