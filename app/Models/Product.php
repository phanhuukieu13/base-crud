<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    public function category() {

        return $this->belongsTo(Category::class);

    }

    public function rules() {
        $rules = [
            'category_id' => 'required',
            'name' => 'required|min:3|max:255',
            'color' => 'required|max:255',
            'price' => 'required|',
            'detail' => 'required|',
            'size' => 'required|',
            'amount' => 'required|'
        ];
        return $rules;
    }
    public function messages() {
        $messages = [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.min' => 'Tên không được dưới 3 ký tự',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'color.required' => 'Vui lòng chọn màu sắc',
            'color.max' => 'Màu sắc vượt quá 255 ký tự',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'detail.required' => 'Vui lòng nhập mô tả sản phẩm',
            'size.required' =>'Vui lòng nhập size sản phẩm',
            'amount.required' =>'Vui lòng nhập số lượng'
        ];
        return $messages;
    }
    public function getProduct(){
        $product = Product::where('is_deleted','=',0);
        return $product;
    }
    public function getProsById ($id) {
        $pros = Product::where([
            'id' => $id,
            'is_deleted' => 0,
        ])->first();
    
        return $pros;
       }
}
