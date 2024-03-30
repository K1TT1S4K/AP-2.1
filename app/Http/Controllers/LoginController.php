<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request) {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->is_admin == 1) {	//หากเป็นแอดมิน ให้ไปที่หน้าแอดมิน
                return redirect()->route('admin.home');
            }
            else {	//หากไม่ใช่ ให้ไปที่หน้า Home ปกติ
                return redirect()->route('dashboard');
            }
        }
        else {	//หากอีเมล กับ รหัสผ่าน ผิด ให้ไปที่หน้าล็อกอิน พร้อมขึ้นข้อความที่กำหนด
            return redirect()->route('login')->with('error',"Email-address and Password are wrong.");

        }
    }
}
