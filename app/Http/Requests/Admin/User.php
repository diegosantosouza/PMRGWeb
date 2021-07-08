<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class User extends FormRequest
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
            'name'=> 'required|max:191',
            're'=> (!empty($this->request->all()['id']) ? 'required|max:6|unique:users,re,' . $this->request->all()['id'] : 'required|max:6|unique:users,re'),
            'secao'=> 'required',
            'email'=> (!empty($this->request->all()['id']) ? 'required|unique:users,email,' . $this->request->all()['id'] : 'required|unique:users,email'),

        ];
    }
}
