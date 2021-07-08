<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table  = 'category';
    protected $fillable = ['category_name'];

    public function product() {

        return $this->hasMany(Product::class);

    }
}
