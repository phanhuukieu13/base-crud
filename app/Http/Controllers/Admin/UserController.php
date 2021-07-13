<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use App\Models\LoginUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function index() {
        $user = new User();
        $getUser = $user->getUser();
        $getUser = $getUser->get();
        $userLogin = LoginUser::all();
        return view('admin.modules.users.index',compact('getUser','userLogin'));

    }

    public function create() {
        return view('admin.modules.users.create');

    }
    public function search(Request $request) {
        $user = new User();
        $getUser = $user->getUser();
        if(!empty($request['search_name'])) {
            $searchName = $request['search_name'];
            $getUser = $getUser
                            ->where('full_name', 'like', "%$searchName%")
                            ->orWhere('phone_number','like',"%$searchName%");

        }
        $getUser = $getUser->get();
        return view('admin.modules.users.index',compact('getUser'));
    }
    public function store(Request $request) {
        $dataSave = new User();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nameImage = uniqid() . '.' .$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $nameImage);
        }
            $dataSave->full_name = $request->full_name;
            $dataSave->phone_number = $request->phone_number;
            $dataSave->address = $request->address;
            $dataSave->old = $request->old;
            $dataSave->image = $nameImage;
            $dataSave->save();
            if($dataSave->save() == true) {
                $dataSaveLogin = [
                    'user_id' =>$dataSave->id,
                    'email' => $request->email,
                    'status' => 0,
                    'is_deleted' => 0,
                    'password' =>  Hash::make($request->password),
                    'deleted_at' => carbon::now(),
                ];
                $dataSaveLogin = DB::table('login_user')->save($dataSaveLogin);
            }
            return redirect()->route('admin.users.index');
    }
    public function edit($id) {
        $userModel = new User();
        $user = $userModel->getUserById($id);
        if(!$user){
            return redirect()->route('admin.users.index');
        }
        return view('admin.modules.users.edit',compact('user'));
    }
    public function update(Request $request, $id) {
        $user = User::find($id);
        $data = $request->all();
        if ($request->hasfile('image')){
            $file = $request->file('image');
            $nameImage = uniqid() . '.' .$file->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $file->move($destinationPath, $nameImage);
        } else {
            return $request;
            $user->image='';
        }
        $user->full_name = $request->full_name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->old = $request->old;
        $user->image = $nameImage;
        $user->save();
        return redirect()->route('admin.users.index');
    }
    public function destroy($id) {
        $user =User::find($id);
        $user->is_deleted = 1;
        $user->save();
        return redirect()->route('admin.users.index');
    }
    public function deActive($id) {
        $user =User::find($id);
        $user->status = 1;
        $user->save();
        return redirect()->route('admin.users.index');
    }
    public function active($id) {
        $user =User::find($id);
        $user->status = 0;
        $user->save();
        return redirect()->route('admin.users.index');
    }
}
