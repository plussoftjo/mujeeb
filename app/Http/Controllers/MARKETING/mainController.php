<?php

namespace App\Http\Controllers\MARKETING;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
class mainController extends Controller
{
    public function index() {
    	$user = User::where('id',Auth::id())->first();
    	return response()->json(['user' => $user]);
    } 
}
