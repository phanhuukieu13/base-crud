<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table  = 'category';
    protected $fillable = [
        'category_name',
    ];

    public function product() {

        return $this->hasMany(Product::class);

    }
    public function rules(){
        $rules = [
            'category_name' => 'required'
        ];
        return $rules;
    }
    public function messages() {
        $messages = [
            'category_name.required' => 'Ten danh muc khong duoc de trong'
        ];
        return $messages;
    }
}
