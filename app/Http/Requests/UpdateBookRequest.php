<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => 'string|nullable|max:255',
            'author' => 'string|nullable',
            'description' => 'string|nullable',
            'genre' => 'string|nullable',
            'image' => 'image|nullable',
            'buy_link' => 'string|nullable',
            'user_id' => 'integer',
        ];
    }
}
