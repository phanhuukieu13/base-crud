<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Carbon\Carbon;
use App\Models\LoginUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function index() {
        $user = new User();
        $getUser = $user->getUser();
        $getUser = $getUser->get();
        return view('admin.modules.users.index',compact('getUser'));

    }

    public function create() {
        return view('admin.modules.users.create');

    }
    public function search(Request $request) {
        $user = new User();
        $getUser = $user->getUser();
        if(!empty($request['search_name'])) {
            $searchName = $request['search_name'];
            $getUser = $getUser->where('full_name', 'like', "%$searchName%");
        }
        if(!empty($request['phone_number'])){
            $searchPhone = $request['phone_number'];
            $getUser = $getUser->where('phone_number','like',"%$searchPhone%");
        }
        if(!empty($request['search_status'])){
            $searchStatus = $request['search_status'];
            $getUser = $getUser->where('status','like',"%$searchStatus%");
        }
        $getUser = $getUser->get();
        return view('admin.modules.users.index',compact('getUser'));
    }
    public function uploadFile(Request $request){
        $data = $request->all();
        $file_name =  null;
        $file = $request->file('image');
        $file_name = uniqid() . '.' . $file->getClientOriginalName();
        $linkFile =  'public/tmp/';
        $file->move($linkFile, $file_name);
        $dir = '/public/tmp/' . $file_name;
        return response()->json(['dir' => $dir, 'file_name' => $file_name]);
    }
    public function store(Request $request) {
        $data = $request->all();
        $fileName = $data['image'];
        $errors = [];
        $success = 0;
        $dataSave = new User();
        $validate = Validator::make($data,$dataSave->rules(),$dataSave->messages());
        if($validate->fails()){
            $validateError = $validate->messages()->get('*');
                foreach ($validateError as $field => $error){
                    $errors[$field] = $validateError[$field][0];
                }
        }else{
            $dataSave->full_name = $request->full_name;
            $dataSave->phone_number = $request->phone_number;
            $dataSave->address = $request->address;
            $dataSave->old = $request->old;
            $dataSave->image = $fileName;
            $dataSave->status = 1;
            $dataSave->is_deleted= 0;
            if ($dataSave->save()) {
                if ($fileName !=null){} {
                    $tmp = $_SERVER['DOCUMENT_ROOT'] . '/public/tmp/' . $fileName;
                    $saveFile = $_SERVER['DOCUMENT_ROOT'] . '/public/img/' . $fileName;
                    rename($tmp, $saveFile);
                    $dataSaveLogin = [
                        'user_id' =>$dataSave->id,
                        'email' => $request->email,
                        'status' => 1,
                        'is_deleted' => 0,
                        'password' =>  Hash::make($request->password),
                        'deleted_at' => Carbon::now(),
                    ];
                    $dataSaveLogin = DB::table('login_user')->insert($dataSaveLogin);
                }
            }
            $success = 1;
        }
        if (empty($errors)) {
            $errors =  null;
        }
        return response()->json(['success' => $success,'errors' => $errors]);
    }
   
    public function edit($id) {
        $userModel = new User();
        $user = $userModel->getUserById($id);
        if(!$user){
            return redirect()->route('admin.users.index');
        }
        return view('admin.modules.users.edit',compact('user'));
    }
    public function update(Request $request) {
        $userModel = new User();
        $data = $request->all();
        $id = $data['id'];
        $user = $userModel->getUserById($id);
        $fileName = $data['image'];
        $errors = [];
        $success = 0;
        $validate = Validator::make($request->all(),$user->rules(),$user->messages());
            if($validate->fails()){
                $validateError = $validate->messages()->get('*');
                    foreach ($validateError as $field => $error){
                        $errors[$field] = $validateError[$field][0];
                    }
            }else{
                $user->full_name = $data['full_name'];
                $user->phone_number = $data['phone_number'];
                $user->address = $data['address'];
                $user->old = $data['old'];
                $user->image = $fileName;
                $user->update();
                if ($user->update()) {
                    if ($fileName !=null){} {
                        $tmp = $_SERVER['DOCUMENT_ROOT'] . '/public/tmp/' . $fileName;
                        $saveFile = $_SERVER['DOCUMENT_ROOT'] . '/public/img/' . $fileName;
                        rename($tmp, $saveFile);
                    }
                }

            }
        $success = 1;
        if (empty($errors)) {
            $errors =  null;
        }
       return response()->json(['success' => $success,'errors' => $errors]);
    }
    public function destroy($id) {
        $userModel = new User();
        $user = $userModel->getUserById($id);
        if(!$user){
            return redirect('admin/users.index');
        }else{
            $user->is_deleted = 1;
            $user->deleted_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->save();
        }
        return redirect()->route('admin.users.index');
    }
    public function deActive($id) {
        $userModel = new User();
        $user = $userModel->getUserById($id);
        if(!$user){
            return redirect('admin/users.index');
        }else{
            $user->status = 2;
            $user->save();  
        }
        return redirect()->route('admin.users.index');
    }
    public function active($id) {
        $userModel = new User();
        $user = $userModel->getUserById($id);
        if(!$user){
            return redirect('admin/users.index');
        }else{
            $user->status = 1;
            $user->save();  
        }
        return redirect()->route('admin.users.index');
    }
}
