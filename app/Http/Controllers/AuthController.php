<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\dd;
//use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request -> all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // dd($validator);
        if($validator -> fails()){
            return response()->json([
                'data' => $request,
                'message' => "Error",
                'status_code' => "400",
            ]);
        }
        $data = request(['email','password']);
        // dd($data);
        if(!Auth::attempt($data)){
            return response()->json([
                'message' => "User Not Found",
                'code' => "500",
            ]);
        }
        // dd($data);
        $user = User::where('email', $request->email)->first();
        // dd($user);
        $token = $user -> createToken('authToken')->plainTextToken;
        // dd(auth()->user());
        return response()->json([
            'token' => $token,
            'message' => 'Login Complete',
            'user' => auth()->user(),
        ]);
        // dd($user);
    }
    public function logout(Request $request){
        $request -> user() -> currentAccessToken() -> delete();
        return response() -> json([
            'status_code' => 200,
            'message' => 'Logout Complete',
        ]);
    }
    //

}
