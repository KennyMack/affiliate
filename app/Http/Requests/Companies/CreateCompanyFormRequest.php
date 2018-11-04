<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

use App\Utils\ImageContent;
use Illuminate\Http\Request;

class CreateCompanyFormRequest extends FormRequest
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
        if (Request::file('image') != null)
            \Session::flash('image', ImageContent::imageToBase64(Request::file('image'), Request::file('image')->getMimeType()));
        else if (Request::input('imgdata'))
            \Session::flash('image', Request::input('imgdata'));


        return [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'imgdata' => 'min:0',
            'companyname' => 'required|min:2|max:120',
            'cnpjcpf' => 'required',
            'status' => 'required|integer|min:0|max:1',
            'city_id' => 'integer',
            'street' => 'min:3|max:120',
            'district' => 'min:3|max:120',
            'number' => 'max:20',
            'postalnumber' => 'max:15',
            'phone' => 'max:60',
            'category_type' => 'required|integer|min:0|max:2',
            'category_id' => 'required|integer|min:0',
            'expertise_id' => 'required|integer|min:0',
            'details' => 'max:255',
            'starttime' => '',
            'endtime' => ''

        ];
    }
}
