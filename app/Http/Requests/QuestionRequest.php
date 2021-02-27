<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class QuestionRequest extends FormRequest
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
/*|unique:questions*/
    public function rules()
    {
        return [
            'image'         => 'nullable|image|max:2048|mimes:png,img,jpg,jpeg,bmp',
            'question'      => 'required|min:10|max:255',
            'answer1'       => 'required|min:2|max:150',
            'answer2'       => 'required|min:2|max:150',
            'answer3'       => 'required|min:2|max:150',
            'answer4'       => 'required|min:2|max:150',
            'correct_answer'=> 'required',
        ];
    }
    public function messages()
    {

        return [
            'image.image'   => 'Sadece Resim Dosyası Eklenebilir.',
            'image.max'     => 'Resim Boyutu 2 MB\'dan Küçük Olmalıdır.',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'question'  => Str::title($this->question),
            'answer1'   => Str::title($this->answer1),
            'answer2'   => Str::title($this->answer2),
            'answer3'   => Str::title($this->answer3),
            'answer4'   => Str::title($this->answer4),
        ]);
    }
        public function attributes()
    {
        return[
            'image'         => 'Resim',
            'question'      => 'Soru',
            'answer1'       => '1. Cevap',
            'answer2'       => '2. Cevap',
            'answer3'       => '3. Cevap',
            'answer4'       => '4. Cevap',
            'correct_answer'=> 'Doğru Cevap',
        ];
    }
}
