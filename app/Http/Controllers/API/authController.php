<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;
class authController extends Controller
{
    public function reg(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required|unique:users', 
            'password' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']);

       $user =  User::create([
            'name' => $input['name'],
            'password' => $input['password'],
            'phone' => $input['phone'],
            'type' => 'customer',
        ]);
        $success['token'] =  $user->createToken('mujeeb')-> accessToken; 
        return response()->json(['success'=>$success], 200); 
    }

    public function login(Request $request)
    {
    	if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')]))
    	{
    		$user = Auth::User(); 
            $success['token'] =  $user->createToken('mujeeb')-> accessToken;
            return response()->json(['success' => $success], 200); 
    	}else {
    		return response()->json(['error'=>'Unauthorised'], 401);
    	}
    }

    
}
