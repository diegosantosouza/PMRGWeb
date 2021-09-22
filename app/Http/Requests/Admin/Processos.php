<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Processos extends FormRequest
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
            'processo_de_execucao'=>'required',
            'n_inquerito'=>'max:191',
            'pena_ano'=>'nullable|numeric',
            'pena_meses'=>'nullable|numeric',
            'pena_dias'=>'nullable|numeric',
            'multa'=>'max:191',
            'medida_tratamento'=>'max:191',
            'comutacao'=>'max:191',
            'transito_julgado'=>'max:191',
            'exticao_punibilidade'=>'max:191',
            'vara_comarca'=>'required|max:191',
            'acidente_doenca_morte'=>'max:191',
        ];
    }
}
