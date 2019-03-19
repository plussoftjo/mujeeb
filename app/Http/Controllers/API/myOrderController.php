<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
class myOrderController extends Controller
{
    public function myOrder() 
    {
    	return response()->json(order::where('auth',Auth::id())->where('state',2)->get());
    }

    public function now()
    {
    	return response()->json(order::where('auth',Auth::id())->where('state',0)->orWhere('state',1)->orWhere('state',4)->first());
    }
}
