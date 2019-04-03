<?php

namespace App\Http\Controllers\SUPPLIERAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\suppliernotf;
use Auth;
use App\User;
use App\order;
use App\supplierresp;
use App\Events\MessageSent;
class orderController extends Controller
{
    public function fetch_order() {
    	$suppliernotf = suppliernotf::where('user_id',Auth::id())->get();

    	return response()->json($suppliernotf);
    }

    public function order($id){
    	$order = order::where('id',$id)->first();
    	$user = User::where('id',$order->auth)->first();

    	return response()->json(['order' => $order,'user'=> $user]);
    }

    public function submit_price(Request $request)
    {
    	$suppliernotf = suppliernotf::where('order_id',$request->order_id)->where('user_id',Auth::id())->update([
    		'state' => 1
    	]);

    	$supplierresp = supplierresp::create([
    		'order_id' => $request->order_id,
    		'user_id' => Auth::id(),
    		'price' => $request->price,
    		'des' => $request->des,
            'team_id' =>$request->team_id
    	]);

    }

    public function takenorders()
    {
        return response()->json(order::where('user_id',Auth::id())->where('state',1)->get());
    }

    public function sendMessage(Request $request)
    {
        if($request->hasImage)
        {
         $message = messages::create([
            'type' => $request->type,
            'order_id' => $request->order_id,
            'message' => $request->message,
            'hasImage' => true
        ]);   
        }
        $message = messages::create([
            'type' => $request->type,
            'order_id' => $request->order_id,
            'message' => $request->message,
            'hasImage' => false
        ]);

        event(new MessageSent($message));
    } 

    public function last_order() {
        return response()->json(order::where('user_id',Auth::id())->where('state',2)->get());
    }

}
