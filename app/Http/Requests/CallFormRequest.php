<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CallFormRequest  extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:128',
            'tel' => 'required|min:6|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'tel' => 'Номер мобильного телефона',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите имя',
            'name.min' => '2 буквы хотя бы...',
            'tel.required' => 'Укажите номер',
            'tel.min' => '6 цифр хотя бы...'
        ];
    }



}
