<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AgentCreateRequest  extends FormRequest
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

    // правила
    public function rules()
    {
        return [
            'name'        =>  'required|min:3|max:100',
            'billing'     =>  'required|min:3|max:100',
            'address'     =>  'required|min:3|max:150',
            'description' =>  'max:150'
        ];
    } // rules

    // сообщения - реакция на несоблюдение правил
    public function messages()
    {
        return [
            'name.required'    =>  'Введите название предприятия',
            'name.min'         =>  'Минимальная длина названия [:min] символов',
            'name.max'         =>  'Максимальная длина названия [:max] символов',
            'billing.min'      =>  'Минимальная длина платёжной информации [:min] символов',
            'billing.max'      =>  'Максимальная длина платёжной информации [:max] символов',
            'billing.required' =>  'Введите платёжную информацию',
            'address.required' =>  'Введите адрес предприятия',
            'address.min'      =>  'Минимальная длина адреса [:min] символов',
            'address.max'      =>  'Максимальная длина адреса [:max] символов',
            'description.max'  =>  'Максимальная длина описания [:max] символов'
        ];
    } // messages
}
