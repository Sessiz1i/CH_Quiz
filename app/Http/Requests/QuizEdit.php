<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class QuizEdit extends FormRequest
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
    public function prepareForValidation()
    {

        $this->merge([
            'title'         => Str::title(strip_tags($this->title)),
            'slug'          => Str::slug($this->title),
            'description'   => strip_tags($this->description),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|min:10|max:150',
            'description'   => 'nullable|min:10|max:500',
            'finished_at'   => 'nullable|date|after:tomorrow',
            'status'        => 'required',

        ];
    }

    public function attributes()
    {
        return[
            'title'          => 'Quiz Başlığı',
            'description'    => 'Quiz Açıklaması',
            'finished_at'    => 'Quiz Bitiş Tarihi',
            'status'         => 'Quiz Durumu'
        ];
    }
}
