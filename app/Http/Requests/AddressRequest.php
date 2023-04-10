<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        return [
            'siteid'            => ['nullable'],
            'parentid'          => ['nullable'],
            'company'           => ['nullable'],
            'vatid'             => ['nullable'],
            'salutation'        => ['nullable'],
            'title'             => ['nullable'],
            'firstname'         => ['required'],
            'lastname'          => ['nullable'],
            'lastname'          => ['nullable'],
            'address1'          => ['required'],
            'address2'          => ['nullable'],
            'address3'          => ['nullable'],
            'postal'            => ['required', 'alpha_num:6'],
            'city'              => ['required', 'alpha_num:6'],
            'state'             => ['nullable'],
            'countryid'         => ['required', 'alpha_num:2'],
            'telephone'         => ['required', 'digits_between:8,10'],
            'telefax'           => ['nullable'],
            'email'             => ['nullable'],
            'website'           => ['nullable'],
            'pos'               => ['nullable'],
            'mtime'             => ['nullable'],
            'ctime'             => ['nullable'],
            'editor'            => ['nullable'],
            'default'            => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'siteid' => '1.',
            'parentid' => auth()->user()->id,
            'company' => '',
            'vatid' => '',
            'salutation' => '',
            'title' => '',
            'lastname' => '',
            'address2' => '',
            'address3' => '',
            'state' => '',
            'telefax' => '',
            'email' => auth()->user()->email,
            'website' => '',
            'mtime' => Carbon::now(),
            'ctime' => Carbon::now(),
            'editor' => auth()->user()->name,
        ]);
    }
}
 