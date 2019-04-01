<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use App\supplierresp;
use App\messages;
use App\User;
use App\Events\MessageSent;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
use App\suppliernotf;
class myOrderController extends Controller
{
    public function myOrder() 
    {
    	return response()->json(order::where('auth',Auth::id())->where('state',2)->get());
    }

    public function now()
    {
    	return response()->json(order::where('auth',Auth::id())->where('state',0)->orWhere('state',1)->get());
    }

    public function price_list($id)
    {
    	return response()->json(order::where('id',$id)->first());
    }

    public function accept_price($id) 
    {
    	$supplierresp = supplierresp::where('id',$id)->first();
    	$supplierrespupdate = supplierresp::where('id',$id)->update(['state' => 1]);
    	$deleteotherresp = supplierresp::where('order_id',$supplierresp->order_id)->where('id','!=',$id)->delete();
        $deleteothernotf = suppliernotf::where('order_id',$supplierresp->order_id)->delete();
    	$order= order::where('id',$supplierresp->order_id)->update([
    		'state' => 1,
    		'user_id' => $supplierresp->user_id
    	]);

        $message = messages::create([
            'type' => 'received',
            'order_id' =>$supplierresp->order_id,
            'message' => 'مرحبا بكم نشكركم على اختيار خدماتنا لأي استفسار تواصل معنا هنا .',
            'hasImage' => false
        ]);
    }

    public function getMessages($id) {
        $messages = messages::where('order_id',$id)->orderBy('id','asc')->get();
        $supplier_id = order::where('id',$id)->value('user_id');
        $auth_id = order::where('id',$id)->value('auth');
        $supplier = User::where('id',$supplier_id)->first();
        $auth = User::where('id',$auth_id)->first();
        return response()->json(['messages' => $messages,'supplier' => $supplier,'auth'=> $auth]);
    }

    public function sendMessage(Request $request)
    {
        if($request->hasImage)
        {
            $image = $request->get('image');
            $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/messages/').$fileNameimage);

            // make message
             $message = messages::create([
                'type' => $request->type,
                'order_id' => $request->order_id,
                'message' => '0',
                'hasImage' => true,
                'image' => 'images/messages/'.$fileNameimage
            ]);
             event(new MessageSent($message));

        }else {
          $message = messages::create([
            'type' => $request->type,
            'order_id' => $request->order_id,
            'message' => $request->message,
            'hasImage' => false
            ]);  
           event(new MessageSent($message));

        }
        

    }

    public function endOrder($id)
    {
        $order = order::where('id',$id)->update([
            'state' => 2
        ]);
        $messages = messages::where('order_id',$id)->delete();

    }
}
