<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendReviewRequest extends FormRequest
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
            'review' => 'string|required',
            'user_id' => 'integer',
            'book_id' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'review' => 'You already reviewed thsi book'
        ];
    }
}
