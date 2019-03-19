<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class loginController extends Controller
{
    public function mlogin(Request $request) {

    	if (Auth::attempt(['phone' => request('phone'), 'password' => request('password')])) {
            // Authentication passed...
            return redirect()->intended('marketing');
        }else {
        	return 'error';
        }
    }
}
