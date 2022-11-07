<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFotoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'foto' => 'required|mimes:jpeg,jpg,png,bmp,gif,svg|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ];
    }

    public function messages()
    {
        return [
            'foto.required' => 'A foto is required',
            'foto.file'  => 'A foto must be in file',
            'foto.image'  => 'A foto must be in image',
            'foto.mimes:jpeg,jpg,png,bmp,gif,svg'  => 'A foto must be in jpeg,jpg,png,bmp,gif,svg',
            'foto.dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'  => 
            'A foto must be in max width 1024px and max max_height 1000px, min width 100px and min height 100px and only 1MB is allowed',
         



        ];
    }
}
