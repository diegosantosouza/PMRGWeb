<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Visitas extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_interno'=>'required',
            'foto'=>'nullable|image',
            'nome'=>'required',
            'sexo'=>'required',
            'parentesco'=>'required',
            'documento'=>'required',
            'tipo_doc'=>'required',
            'dt_nascimento'=>'required',
            'naturalidade'=>'required',
            'uf'=>'required',
            'nacionalidade'=>'required',
            'pai'=>'nullable',
            'mae'=>'nullable',
            'endereco'=>'required',
            'cidade'=>'required',
//            'cep'=>'required',
            'celular'=>'required',
            'status'=>'required',
            'antecedentes'=>'nullable',
            'autorizacao_judicial'=>'nullable',
            'autorizacao_menor'=>'nullable',
            'data_suspencao'=>'nullable',
            'observacoes'=>'nullable'
        ];
    }
}
