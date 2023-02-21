<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate;

class AjaxSaveRequest extends FormRequest
{

    public function authorize()
    {
        // можно было просто вернуть true здесь это непринципиально
        return Gate::check('admin');
//        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
            'data' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'id' => 'Нет параметра id',
            'data.min' => '3 символа хотя бы ...',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()
            ->json(['success' => false, 'errors' => $validator->errors()], 422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag);
    }
}
