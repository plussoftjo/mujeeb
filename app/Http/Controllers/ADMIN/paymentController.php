<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\payment;
use App\User;
use App\supplier;
class paymentController extends Controller
{
 	public function index() {
 		$payment = payment::get();
 		return response()->json($payment);
 	}

 	public function show($id) 
 	{
 		$user_id = payment::where('id',$id)->value('user_id');
 		$user = User::where('id',$user_id)->first();
 		return response()->json($user);
 	} 

 	public function approve($payment_id,$user_id,Request $request)
 	{
 		$supplier_cash = supplier::where('user_id',$user_id)->value('cash');
 		$new_cash = $supplier_cash - $request->cash;
 		$user = supplier::where('user_id',$user_id)->update([
 			'cash' => $new_cash
 		]);
 		$payment = payment::where('id',$payment_id)->delete();
 		return response()->json(['cash' => $new_cash,'supplier_cash' => $supplier_cash]);
 	}
}
