<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteBooksRequest extends FormRequest
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
        $rules = [
            'fio' => 'required|string',
            'company' => 'string',
            'tel' => 'required|string',
            'email' => 'required|email|string',
            'date' => 'required',
           'foto' => 'required|mimes:jpeg,jpg,png,bmp,gif,svg|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ];
  
        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return[
                    'fio' => 'required|string',
                    'company' => 'string',
                    'tel' => 'required|string',
                    'email' => 'required|email|string',
                    'date' => 'required',
                    'foto' => 'required',                   
                ];
            

        }








        return $rules;
    }


    public function messages()
    {
        return [
            'fio.required' => 'A fio is required',
            'fio.string'  => 'A fio must be in string',
            'company.string'=> 'A company must be in string',
            'tel.required' => 'A tel is required',
            'tel.string'  => 'A tel must be in string',
            'email.required' => 'A email is required',
            'email.string'  => 'A email must be in string',
            'email.email'  => 'A email must be in string',
            'date.required' => 'A date is required',
            'date.date_format'  => 'A date must be in format: Y-m-d',
            'foto.required' => 'A foto is required',
            'foto.file'  => 'A foto must be in file',
            'foto.image'  => 'A foto must be in image',
            'foto.mimes:jpeg,jpg,png,bmp,gif,svg'  => 'A foto must be in jpeg,jpg,png,bmp,gif,svg',
            'foto.dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'  => 
            'A foto must be in max width 1024px and max max_height 1000px, min width 100px and min height 100px and only 1MB is allowed',
         



        ];
    }
}
