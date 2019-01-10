<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index()
    {

        return view(self::ADMIN_VIEW_PREFIX . '.login.index');
    }

    public function create()
    {
        $model = new User();
        $model->name = 'xiaobai';
        $model->email = 'xiaobai@gmail.com';
        $model->password = Hash::make('y654321');
        $model->save();
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $data = $request->only(['name','password']);

        if(Auth::attempt($data)){
            return response()->json(['message'=>'登陆成功','url'=>'home']);
        }

        return response()->json(['message'=>'账号或密码错误！'],403);

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect('/' . self::ADMIN_PREFIX .'/login');
    }
    
}