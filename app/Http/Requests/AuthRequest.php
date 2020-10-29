<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
   * Get the alias attributes for the defined validation rules.
   *
   * @return array
   */
  public function attributes()
  {
    return [
      'name'     => 'nome do usuario',
      'surname'  => 'apelidos do usuario',
      'email'    => 'email do usuario',
      'image'    => 'imagem del usuario',
      'password' => 'password do usuario',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'name.required'     => ':attribute é um campo requerido',
      'surname.required'  => ':attribute é um campo requerido',
      'email.required'    => ':attribute é um campo requerido',
      'email.unique'      => ':attribute já existe na nossa base de datos',
      'email.email'       => ':attribute tem que ser um email válido',
      'mobile.required'   => ':attribute é um campo requerido',
      'image.required'    => ':attribute é um campo requerido',
      'password.required' => ':attribute é um campo requerido',
    ];
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {

    switch ($this->method()) {
      case 'POST':
        {
          return [
            'name'     => [
              'required',
            ],
            'surname'  => [
              'required',
            ],
            'email'    => [
              'required',
              'email',
              'unique:users,email',
            ],
            'image'    => [
              'required',
              'image',
            ],
            'password' => [
              'required',
            ],
          ];
        }
      case 'PUT':
      case 'PATCH':
        {
          return [
            'name'    => [
              'required',
            ],
            'surname' => [
              'required',
            ],
          ];
        }
      default:break;
    }
  }
}
