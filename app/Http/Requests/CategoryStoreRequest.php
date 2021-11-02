<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'description' => 'required|min:2|max:191',
            'parent_id' => 'required|not_in:0',
            'featured' => '',
            'menu' => '',
            'category_image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Popunite naziv kategorije!',
            'description.required' => 'Popunite opis kategorije!',
            'parent_id.required' => 'Odaberite roditelj kategorije!',
            // FEAT-finish messages for validation!
        ];
    }
}
