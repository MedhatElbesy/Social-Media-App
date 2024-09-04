<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTweetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tweet' => 'required|string|max:140',
        ];
    }

    public function messages()
    {
        return [
            'tweet.required' => 'Tweet Is Required',
            'tweet.string'   => 'Tweet Must Be String',
            'tweet.max'      => 'Tweet Not Allow To Be Greater Than 140 Characters',
        ];
    }
}
