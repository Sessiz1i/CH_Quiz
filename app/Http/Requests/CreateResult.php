<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateResult extends FormRequest
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
            '*question*' => 'required'
        ];
    }
    public function messages()
    {
        return [
            '*question*.required' => 'lütfen bir cevap seçiniz'
        ];
    }

    public function attributes()
    {
        return [
            '*question*' => 'cevap'

        ];
    }
}
