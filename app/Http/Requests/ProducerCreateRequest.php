<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProducerCreateRequest extends FormRequest
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
        //валидация
        return [
            'name'=>'required|string|between:2,255',
            'country'=>'required|string|between:2,255'
        ];
    }
    public function messages()
    {
        //сообщения
        return [
            'name.required' => 'Поле "Наименование" обязательно к заполнению!',
            'country.required' => 'Поле "Страна" обязательно к заполнению!',
            'name.between:2,255' => 'Превышен размер поля "Наименование"',
            'country.between:2,255' => 'Превышен размер поля "Страна"',
        ];
    }
}
