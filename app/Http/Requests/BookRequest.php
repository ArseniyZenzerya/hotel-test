<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'tel' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'email.required' => 'Будь ласка, вкажіть вашу електронну пошту.',
            'email.email' => 'Будь ласка, вкажіть дійсну електронну пошту.',
            'tel.required' => 'Будь ласка, вкажіть номер вашого телефону.',
            'check_in.required' => 'Будь ласка, вкажіть дату заїзду.',
            'check_in.date' => 'Будь ласка, вкажіть дійсну дату заїзду.',
            'check_out.required' => 'Будь ласка, вкажіть дату виїзду.',
            'check_out.date' => 'Будь ласка, вкажіть дійсну дату виїзду.',
        ];
    }
}
