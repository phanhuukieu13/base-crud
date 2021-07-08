<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LoginUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function index() {
        $user = User::all();
        return view('admin.modules.users.index',compact('user'));

    }

    public function create() {
        return view('admin.modules.users.create');
    
    }

    public function store(Request $request) {
        $success = 0;
        $errors = [];
        $dataSave = new User();
        $validate = Validator::make($request->all() , $dataSave->rules(), $dataSave->messages());
        if ($validate->fails()) {
            $validateErrors =  $validate->messages()->get('*');
            foreach ($validateErrors as $field => $error) {
                $errors[$field] = $validateErrors[$field][0];
            }
        } else {
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
                        'password' =>  Hash::make($request->password)
                    ];
                    $dataSaveLogin = DB::table('login_user')->insert($dataSaveLogin);
                    $success = 1;
                }
        }
        if (empty($errors)) {
            $errors =  null;
        }
        return response()->json(['success'=>$success, 'error' => $errors]);
    }
    public function edit($id) {
        $user = User::find($id);
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
}
