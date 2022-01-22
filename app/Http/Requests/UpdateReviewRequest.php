<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'review' => 'string|required',
            'user_id' => 'integer',
            'book_id' => 'integer'
        ];
    }
}
