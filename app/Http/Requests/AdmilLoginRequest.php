<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmilLoginRequest extends FormRequest
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
        return [
            'email'=> 'required|unique:admins,email',
            'password'=>'required'
        ];
    }
    public function messages()
    {
        return[
            'email.required'=>'يجب ادخال البريد الالكترونى',
            'email.email'=>'صيغة البريد الالكترونى غير صحيحه',
            'password.required'=>'يجب اخال كلمة المرور'
        ];
    }
}
