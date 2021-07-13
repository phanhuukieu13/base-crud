<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequests extends FormRequest
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
    public function rules(){
        $rules = [
            'email' => 'required|max:255|unique:login_user',
            'password' => 'required|max:30|min:6|',
            'full_name' => 'required|min:1|max:255',
            'phone_number' => "required|min:8|max:14|unique:users",
            'address' => 'required|min:4|max:255',
            'old' => 'required|max:3'
        ];
        return $rules;
    }
    public function messages(){
        $messages = [
            'email.required' => 'Email không được để trống',
            'email.max' => 'Email không được quá 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'full_name.required' => 'Tên không được để trống',
            'full_name.min' => 'Tên không được dưới 1 ký tự',
            'full_name.max' => 'Tên không vượt quá 255 ký tự',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'phone_number.min' => 'Số điện thoại không được dưới 6 ký tự',
            'phone_number.max' => 'Số điện thoại không được quá 14 ký tự',
            'address.required' => 'Địa chỉ không được để trống',
            'address.min' => 'Địa chỉ không được dưới 4 ký tự',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
            'old.required' =>'Tuổi không được để trống',
            'old.max' => 'Tuổi không được quá 3 ký tự'
        ];
        return $messages;
    }
}
