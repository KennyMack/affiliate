<?php

namespace App\Http\Requests\Demograph;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStateFormRequest extends FormRequest
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
            'name' => 'required|max:60',
            'initials' => 'required|unique:states,initials,'.$this->id.'|max:3',
            'ibge' => 'required',
            'country_id' => 'integer|min:0|required',
        ];
    }
}
