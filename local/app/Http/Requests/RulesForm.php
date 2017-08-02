<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class RulesForm extends FormRequest
{
     protected $redirect = "login";
    
    
    public function rules()
    {
        return [
            'username' => 'required|regex:/^[a-z]+$/i',
            'password' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'username.required' => 'el nombre de usuario es requerido',
            'username.regex' => 'solo se aceptan letras',
            'password.required' => 'la contraseña es requerida',
        ];
    }
    
    public function response(array $errors)
    {
      return redirect($this->redirect)
      ->withErrors($errors, 'formulario')
      ->withInput();
    }

    public function authorize()
    {
        return true;
    }
}
