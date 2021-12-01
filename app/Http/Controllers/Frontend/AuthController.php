<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);
        if ($validator->failed())
        {
            return response()->json(['errors'=>$validator->errors()->all()], 402);
        }
        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        $user = auth()->attempt($credentials);
        if($user){
            $user_login_token= auth()->user()->createToken('Passport')->accessToken;
            $response = ['status' =>200 ,'token' => $user_login_token];
            return response()->json($response, 200);
        }else {
                $response = ['error' => 'UnAuthorised Access' , 'status' =>401];
                return response()->json($response);
            }

    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' =>'required|min:3',
            'lastname' =>'required|min:3',
            'email' =>'required|string|email|max:255|unique:users',
            'password' =>'required|min:8',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>true ,'message'=>$validator->errors()],200);
        }

        $data = [];
        $data['name'] =$request->firstname .' '.$request->lastname;
        $data['email'] = $request->email;
        $data['profile_img']= 'profile_img.png';
        $data['password']= bcrypt($request->password);
        $user = User::create($data);
        if ($user){
            $token = $user->createToken('Passport')->accessToken;
            return response()->json([
               'token'=>$token
            ],200);
        }else{
            return response()->json(['msg'=>'something wrong', 'status'=>401]);
        }
    }

    public function authenticatedUserDetails(){
        //returns details
        return response()->json(['user' => auth()->user()], 200);
    }

}
