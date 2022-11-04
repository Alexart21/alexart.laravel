<?php


namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContentFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'page' => 'required|min:3|max:128',
            'title' => 'required|min:6|max:128',
            'title_seo' => 'min:6|max:128',
            'description' => '',
            'page_text' => 'required',
        ];
    }

    /*public function attributes()
    {
        return [
            'page' => '',
            'title' => '',
            'title_seo' => '',
            'description' => '',
            'page_text' => '',
        ];
    }*/

}
