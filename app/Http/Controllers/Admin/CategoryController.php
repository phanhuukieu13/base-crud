<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator ;
class CategoryController extends Controller
{

    public function index(Request $request){
        $catModel = new Category();
        $cate = $catModel->getAllCategories();
        $productsModel = new Product();
        $products = $productsModel->getProduct()->paginate(5);
        if(!empty($request['search_name'])) {
            $searchName = $request['search_name'];
            $cate = $cate->where('category_name', 'like', "%$searchName%");
        }
        if(!empty($request['search_status'])) {
            $searchName = $request['search_status'];
            $cate = $cate->where('status', 'like', "%$searchName%");
        }
        $cate = $cate->paginate(5);
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
        return response()->json(['success'=>$success, 'error' => $errors]);
    }
    public function edit($id){
        $cateModel = new Category();
        $cate = $cateModel->getCatesById($id);
        $productsModel = new Product();
        $products = $productsModel->getProsById ($id);
        if(!$cate){
            return redirect()->route('admin.cates.index');
        }elseif($products){
            return redirect()->route('admin.cates.index');
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
        $cate->deleted_at = Carbon::now();
        $cate->save();
    }
    public function active($id){
        $cateModel = new Category();
        $cate= $cateModel->getCatesById ($id);
        $cate->status = 0;
        $cate->save();
        return redirect()->route('admin.cates.index');
    }
    public function deActive($id) {
        $cateModel = new Category();
        $cates = $cateModel->getCatesById ($id);
        if(!$cates){
            return redirect('admin/cates.index');
        }else {
            if ($cates->status ==1 ){
                $cates->status = 2;
                $cates->save();
            }else {
                $cates->status = 1;
                $cates->save();
            }
        }
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
    public function deleteMultiple(Request $request){
        $data = $request->all();
        $ids =json_decode($data['id']);
        foreach($ids as $cates){
             Category::whereIn('id',explode(",",$cates))->update(['is_deleted'=> 1]);
        }
        return response()->json(['status'=>true,'message'=>"Cate deleted successfully."]);
    }
}
