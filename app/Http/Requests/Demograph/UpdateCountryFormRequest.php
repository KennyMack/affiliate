<?php

namespace App\Http\Requests\Demograph;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryFormRequest extends FormRequest
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
            'name' => 'required|max:120',
            'initials' => 'required|unique:countries,initials,'.$this->id.'|max:3'
        ];
    }
}
