<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::get();
        $viewCate = Category::get();
        return view('admin.modules.products.index',compact('products','viewCate'));
    }
    public function create(){
        $cateName = DB::table('category')->get();
        return view('admin.modules.products.create',compact('cateName'));
    }
    public function search(Request $request){
        $viewCate = Category::get();
        $products =Product::get();
        if(!empty($request['search_category'])) {
            $searchName = $request['search_category'];
            $products = DB::table('products')
                            ->where('category_id', 'like', "%$searchName%")
                            ->get();

        }
        if(!empty($request['search_name'])) {
            $searchName = $request['search_name'];
            $products = DB::table('products')
                            ->where('name', 'like', "%$searchName%")
                            ->get();
        }
        
        return view('admin.modules.products.index',compact('products','viewCate'));
    }
    public function store(Request $request){
        $data = $request->all();
        $pd = new Product();
        $pd->category_id = $request->category_id;
        $pd->name = $request->name;
        $pd->color = $request->color;
        $pd->size = $request->size;
        $pd->amount = $request->amount;
        $pd->price = $request->price;
        $pd->detail = $request->detail;
        $pd->is_deleted = 0;
        $pd->save();
    }
    public function edit($id){
        $products = Product::find($id);
        $nameCate = Category::get();
        return view('admin.modules.products.edit',compact('products','nameCate'));    
    }
    public function update(Request $request, $id){
        $products = Product::find($id);
        $products->category_id = $request->category_id;
        $products->name = $request->name;
        $products->color = $request->color;
        $products->size = $request->size;
        $products->amount = $request->amount;
        $products->price = $request->price;
        $products->detail = $request->detail;
        $products->is_deleted = 0;
        $products->update();
        
    }
    public function destroy($id){
        $data =Product::find($id);
        $data->is_deleted = 1;
        $data->save();
        return redirect()->route('admin.pros.index');
    }
}
