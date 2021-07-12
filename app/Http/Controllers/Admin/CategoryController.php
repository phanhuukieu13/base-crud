<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator ;
class CategoryController extends Controller
{
    
    public function index(Request $request){
        
        $cate = Category::all();
        $products = Product::all();
        if(!empty($request['search_name'])) {
            $searchName = $request['search_name'];
            $cate = DB::table('category')
                            ->where('category_name', 'like', "%$searchName%")
                            ->get();
        }
        return view('admin.modules.category.index',compact('cate','products'));
    }
    public function create(){
        return view('admin.modules.category.create');
    }
    public function store(Request $request){
        $success = 0;
        $errors = [];
        $dataSave = new Category();
        $data = Validator::make($request->all(), $dataSave->rules(), $dataSave->messages());
        if($data->fails()){
            $dataError = $data->messages()->get('*');
            foreach ($dataError as $field  =>$error){
                $errors[$field] = $dataError[$field][0];
            }
        } else{
            $dataSave->category_name = $request->category_name;
            $dataSave->status = 0;
            $dataSave->is_deleted = 0;
            $dataSave->save();
        }
         $request->session()->flash('status', 'Tạo danh muc thành công!');
        return response()->json(['success'=>$success, 'error' => $errors]);
    }
    public function edit($id){
        $cate = Category::find($id);
        $products = Product::find($id);
        if($cate->is_deleted === 1){
            return redirect()->route('admin.users.index');
        }elseif($products->id_deleted === 1){
            return redirect()->route('admin.users.index');
        }
        return view('admin.modules.category.edit',compact('cate'));
    }
    public function update(Request $request){
        $dataPost = $request->all();
        $id = $dataPost['id_cate'];
        $cate = Category::find($id);
        $success = 0;
        $errors = [];
        $dataSave = new Category();
        $data = Validator::make($request->all(), $dataSave->rules(), $dataSave->messages());
        if($data->fails()){
            $dataError = $data->messages()->get('*');
            foreach ($dataError as $field  =>$error){
                $errors[$field] = $dataError[$field][0];
            }
        } else{
            $cate->category_name = $request->category_name;
            $dataSave->status = 0;
            $cate->save();
        }
        return response()->json(['success'=>$success, 'error' => $errors]);
    }
    public function destroy($id){
        $cate = Category::find($id);
        $cate->is_deleted = 1;
        $cate->save();
    }
}
