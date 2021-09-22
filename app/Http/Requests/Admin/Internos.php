<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Internos extends FormRequest
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
    public function all($keys = null)
    {
        return $this->validateFields(parent::all());
    }

    public function validateFields(array $inputs)
    {
        $inputs['cpf'] = str_replace(['.', '-'], '', $this->request->all()['cpf']);
        return $inputs;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome_completo'=>'required|min:3|max:191',
            'foto'=> 'image',
            'sexo'=>'required',
            'cpf'=>(!empty($this->request->all()['id']) ? 'required|unique:internos,cpf,' . $this->request->all()['id'] : 'required|unique:internos,cpf'),
            'rg'=>'required|min:3|max:191',
            'nascimento'=>'required',
            'org_expedidor'=>'min:2|max:191',
            'natural'=>'required',
            'titulo_eleitor'=>'nullable|numeric|max:9999999999999999',
            'zona'=>'nullable|numeric|max:9999999999999999',
            'secao'=>'nullable|numeric|max:9999999999999999',
            'estado_civil'=>'required',
            'conjugue'=>'max:191',
            'altura'=>'numeric|max:9999',
            'peso'=>'numeric|max:9999',
            'defeitos_fisicos'=>'max:191',
            'sinais_nascenca'=>'max:191',
            'cicatrizes'=>'max:191',
            'tatuagens'=>'max:191',
            'mae'=>'max:191',
            'pai'=>'max:191',
            'endereco'=>'max:191',
            'nome_guerra'=>'required|min:2|max:191',
            're'=>(!empty($this->request->all()['id']) ? 'required|unique:internos,re,' . $this->request->all()['id'] : 'required|unique:internos,re'),
//            'funcional'=>'required|max:11',
            'patente'=>'required',
            'situacao'=>'required',
            'batalhao'=>'required',
            'batalhao_cidade'=>'required',
            'n'=>(!empty($this->request->all()['id']) ? 'required|numeric|unique:internos,n,' . $this->request->all()['id'] : 'required|numeric|unique:internos,n'),
            'alojamento'=>'required|max:191',
            'estagio'=>'required',
            'status'=>'required',
            'created_at'=>'required',
            'tipo_prisao'=>'required|max:191',
            'procedencia'=>'required|max:191',
            'local'=>'max:191',

        ];
    }

    public function messages()
    {
        return [
            'created_at.required'=> 'O campo data de inclusão é obrigatório',
        ];
    }
}
