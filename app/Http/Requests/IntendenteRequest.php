<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntendenteRequest extends FormRequest
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
        $rules = [

            'intendente' => 'required',
            'votos' => 'required',
            'id_mesa' => 'required',
        ];

        if(!(empty($this->acta))){            

            $rules = array_merge($rules, [

                'acta' => 'image',                
            ]);

        }

        return $rules;

    }
}
