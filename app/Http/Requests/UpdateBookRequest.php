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
    // public function authorize()
    // {
    //     return Auth::check();
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|required|max:255',
            'author' => 'string|required',
            'description' => 'string|required',
            'genre' => 'string|required',
            'image' => 'image',
            'buy_link' => 'string|nullable',
            'user_id' => 'integer',
        ];
    }
}
