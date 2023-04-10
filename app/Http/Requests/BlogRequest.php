<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->blog_id == null){
            return [
                'title' => 'required',
                'description' => 'required',
                'images' => 'required',
                'status' => 'required',
                'tag' => 'required',
                'writer' => 'required',
                'city' => 'required',
                'country' => 'required',
            ];
        }else{
            return [
                
            ];
        }

    }
}
