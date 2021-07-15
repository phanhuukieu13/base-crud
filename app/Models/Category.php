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

        return $this->hasMany(Product::class, 'category_id','id' );

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

    public function getCategory(){
        $category = Category::where('is_deleted' ,'=', 0);
        return $category;
    }
    public function getCatesById ($id) {
        $cates = Category::where([
            'id' => $id,
            'is_deleted' => 0,
        ])->first();
    
        return $cates;
       }
    public function getAllCategories() {
        $categorios = Category::with(['product'])->where([
            'is_deleted' => 0
        ]);
        return $categorios;
    }

}
