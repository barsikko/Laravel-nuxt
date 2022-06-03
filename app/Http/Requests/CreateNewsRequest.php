<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'string|required',
            'content' => 'string|required',
            'image' => 'string|nullable',
            'pubDate' => 'date_format:Y/m/d H:i|after_or_equal:' . now(),
        ];
    }
}
