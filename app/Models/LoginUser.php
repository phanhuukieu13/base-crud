<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginUser extends Model
{
    protected $table = 'login_user';
    protected $fillable = [
        'user_id',
        'email',
        'password',
    ];
    public function rules(){
        $rules = [
            'email' => 'required|max:255',
            'password' => 'required|',
        ];
        return $rules;
    }
    public function messages(){
        $messages = [
            'email.required' => 'Email không được để trống',
            'email.max' => 'Email không được quá 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống'
        ];
    }
}
