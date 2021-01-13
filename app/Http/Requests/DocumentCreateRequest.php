<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class DocumentCreateRequest extends FormRequest
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
            'date'        =>  'date'
        ];
    } // rules

    // сообщения - реакция на несоблюдение правил
    public function messages()
    {
        return [
            'date.date'    =>  'Не указана дата документа!'
        ];
    } // messages
}
