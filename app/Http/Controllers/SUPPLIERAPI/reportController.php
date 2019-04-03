<?php

namespace App\Http\Controllers\SUPPLIERAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use Carbon\Carbon;
class reportController extends Controller
{
    public function today() {
    	$fetch = order::where('user_id',Auth::id())->where('state',2)->whereDate('created_at', Carbon::today())->get();
    	return response()->json($fetch);
    }
    public function week() {
    	$fetch = order::where('user_id',Auth::id())->where('state',2)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    	return response()->json($fetch);
    }

    public function month() {
    	$fetch = order::where('user_id',Auth::id())->where('state',2)->where('created_at', '>=', Carbon::now()->startOfMonth())->get();
    	return response()->json($fetch);
    }
}
