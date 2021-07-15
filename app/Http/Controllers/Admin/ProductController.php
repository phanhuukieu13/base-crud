<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $productsModel = new Product();
        $products = $productsModel->getProduct();
        $products = $products->get();
        $cateModel = new Category();
        $viewCate = $cateModel->getCategory();
        $viewCate = $cateModel->get();
        return view('admin.modules.products.index',compact('products','viewCate'));
    }
    public function create(){
        $cateModel = new Category();
        $cateName = $cateModel->getCategory()->get();
        return view('admin.modules.products.create',compact('cateName'));
    }
    public function search(Request $request){
        $productsModel = new Product();
        $cateModel = new Category();
        $viewCate = $cateModel->getCategory()->get();
        $products = $productsModel->getProduct();

        if(!empty($request['search_category'])) {
            $searchCate = $request['search_category'];
            $products = $products->where('category_id', 'like', "%$searchCate%");
        }

        if(!empty($request['search_name'])) {
            $searchName = $request['search_name'];
            $products = $products->where('name', 'like', "%$searchName%");
        }

        if(!empty($request['search_status'])){
            $searchStatus = $request['search_status'];
            $products = $products->where('status','like',"%$searchStatus%");
        }
        $products  = $products->get();
        return view('admin.modules.products.index',compact('products','viewCate'));
    }
    public function store(Request $request){
        $success = 0;
        $errors = [];
        $pd = new Product();
        $data = Validator::make($request->all(), $pd->rules(),$pd->messages());
        if($data->fails()){
            $dataError = $data->messages()->get('*');
            foreach($dataError as $field => $error){
                $errors[$field] = $dataError[$field][0];
            }
        }else{
            $pd->category_id = $request->category_id;
            $pd->name = $request->name;
            $pd->color = $request->color;
            $pd->size = $request->size;
            $pd->amount = $request->amount;
            $pd->price = $request->price;
            $pd->detail = $request->detail;
            $pd->is_deleted = 0;
            $pd->status = 1;
            $pd->save();
        }
        
        return response()->json(['success'=>$success, 'error' => $errors]);
    }
    public function edit($id){
        $productsModel = new Product();
        $products = $productsModel->getProsById($id);
        $cate = new Category();
        $nameCate = $cate->getCategory()->get();
        if(!$products){
            return redirect()->route('admin.users.index');
        }
      
        return view('admin.modules.products.edit',compact('products','nameCate'));    
    }
    public function update(Request $request){
        $dataPost = $request->all();
        $id = $dataPost['id'];
        $productsModel = new Product();
        $products = $productsModel->getProsById ($id);
        $success = 0;
        $errors = [];
        $data = Validator::make($request->all(),$products->rules(),$products->messages());
        if($data->fails()){
            $dataError = $data->messages()->get('*');
            foreach($dataError as $field => $error){
                    $errors[$field]= $dataError[$field][0];
            }
        }else{
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
        return response()->json(['success'=>$success, 'error' => $errors]);
    }
    public function destroy($id){
        $dataModel = new Product();
        $data =$dataModel->getProsById ($id);
        $data->is_deleted = 1;
        $data->deleted_at = Carbon::now('Asia/Ho_Chi_Minh');
        $data->save();
        return redirect()->route('admin.pros.index');
    }
    public function Active($id){
        $dataModel = new Product();
        $data = $dataModel->getProsById ($id);
        $data->status = 1;
        $data->save();
        return redirect()->route('admin.pros.index');
    }
    public function DeActive($id){
        $dataModel = new Product();
        $data = $dataModel->getProsById ($id);
        $data->status = 2;
        $data->save();
        return redirect()->route('admin.pros.index');
    }
}
