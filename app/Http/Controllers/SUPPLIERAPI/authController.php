<?php

namespace App\Http\Controllers\SUPPLIERAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
class authController extends Controller
{
    public function fetch() {
    	return response()->json(User::where('id',Auth::id())->first());
    }
}
