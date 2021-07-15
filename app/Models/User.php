<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'full_name', 'phone_number', 'image', 'address', 'old'
    ];

   public function rules(){
       $rules = [
           'full_name' => 'required|min:1|max:255',
            'phone_number' => "required|min:8|max:14",
            'image' => 'required',
            'address' => 'required|min:4|max:255',
            'old' => 'required',
            // 'password' => 'required|max:20',
       ];
       return $rules;
   }
   public function messages(){
        $messages = [
            'full_name.required' => 'Tên không được để trống',
            'full_name.min' => 'Tên không được dưới 1 ký tự',
            'full_name.max' => 'Tên không vượt quá 255 ký tự',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'phone_number.min' => 'Số điện thoại không được dưới 6 ký tự',
            'phone_number.max' => 'Số điện thoại không được quá 14 ký tự',
            'image.required' => 'Ảnh không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'address.min' => 'Địa chỉ không được dưới 4 ký tự',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
            'old.required' =>'Tuổi không được để trống',
            'old.max' => 'Tuổi không được quá 3 ký tự'
        ];
        return $messages;
   }

   public function getUser(){
    $user = User::where('is_deleted','=', 0);
    return $user;
   }

   public function getUserById ($id) {
    $user = User::where([
        'id' => $id,
        'is_deleted' => 0,
    ])->first();

    return $user;
   }

   public function getEdit(){
        $user = User::select('User.*')->where('is_deleted','=', 0);
        return $user;
   }
}
