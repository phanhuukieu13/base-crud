<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
    public function index(){
        $cate = Category::all();
        $countPd = DB::table('category')
                    ->join('products','category.id','=','products.category_id')
                    ->count('products.category_id');
        return view('admin.modules.category.index',compact('cate','countPd'));
    }
    public function create(){
        return view('admin.modules.category.create');
    }
    public function store(Request $request){
        $data = $request->all();
        $dataSave = new Category();
        $dataSave->category_name = $request->category_name;
        $dataSave->is_deleted = 0;
        $dataSave->save();
    }
    public function edit($id){
        $cate = Category::find($id);
        return view('admin.modules.category.edit',compact('cate'));
    }
    public function update(Request $request, $id){
        $cate = Category::find($id);
        $cate->category_name = $request->category_name;
        $cate->save();
    }
    public function destroy($id){
        $cate = Category::find($id);
        $cate->is_deleted = 1;
        $cate->save();
    }
}
