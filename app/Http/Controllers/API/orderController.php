<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\feedback;
use App\supplier;
use App\profile;
use App\suppliernotf;
use App\messages;
use App\supplierresp;
class orderController extends Controller
{
    public function store(Request $request)
    {
    	$images = '';
    	foreach ($request->get('images') as $image) {
        	$fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        	Image::make($image)->resize(400,400)->save(public_path('images/order/').$fileNameimage);
        	if($images == '')
        	{
        		$images = 'images/order/'.$fileNameimage;
        	}else {
        		$images = $images.',images/order/'.$fileNameimage;
        	}
    	}

    	// $supplier_id = supplier::where('user_id',$request->supplier_id)->value('id');

    	$order = order::create([
    		'auth' => Auth::id(),
    		'user_id' => $request->supplier_id,
    		'date' => $request->date,
    		'lngLat' => $request->lngLat,
    		'des' => $request->note,
    		'images' => $images,
    		'type' => 'direct',
    		'catg_id' => $request->catg_id,
    		'subcatg_id' => $request->service

    	]);
    }

    public function order_price(Request $request)
    {
   		 $images = '';
    	foreach ($request->get('images') as $image) {
        	$fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        	Image::make($image)->resize(400,400)->save(public_path('images/order/').$fileNameimage);
        	if($images == '')
        	{
        		$images = 'images/order/'.$fileNameimage;
        	}else {
        		$images = $images.',images/order/'.$fileNameimage;
        	}
    	}
		$supplier_id = supplier::where('user_id',$request->supplier_id)->value('id');
    	$order = order::create([
    		'auth' => Auth::id(),
    		'user_id' => 0,
    		'date' => $request->date,
            'time' => $request->time,
    		'lngLat' => $request->lngLat,
    		'des' => $request->note,
    		'images' => $images,
    		'type' => 'order_price',
    		'catg_id' => $request->catg_id,
    		'subcatg_id' => $request->service

    	]);

        // get User Place
        $auth_id = Auth::id();

        $profile_subcity_id = profile::where('user_id',$auth_id)->value('subcity_id');

        $suppliers = supplier::where('subcity_id','like','%'.$profile_subcity_id.'%')->where('catg_id','like','%'.$order->catg_id.'%')->get();

        foreach ($suppliers as $supplier) {
            $supplier_userid = $supplier->user_id;
            $suppliernotf  = suppliernotf::create([
            'order_id' => $order->id,
            'user_id' => $supplier_userid
            ]); 
        }

    }

    public function approve_order($id)
    {
        $order = order::where('id',$id)->update([
            'state' => 2
        ]);
    }

    public function feedback(Request $request)
    {
        $feedback = feedback::create([
            'user_id' => Auth::id(),
            'supplier_id' => $request->supplier_id,
            'note' => $request->note,
            'rate' => $request->rate,
            'order_id' => $request->order_id
        ]);

        $order = order::where('id',$request->order_id)->update([
            'state' => 2
        ]);
        $messages = messages::where('order_id',$request->order_id)->delete();

        $fetchfeedback = feedback::where('supplier_id',$request->supplier_id)->get();
        $number = 0;
        $count_loop =0;
        foreach ($fetchfeedback as $k) {
            $number = $number + $k->rate;
            $count_loop = $count_loop + 1; 
        }
        $rate = $number / $count_loop;

        $rate = round($rate);

        $count = supplier::where('user_id',$request->supplier_id)->value('count');
        $cash = supplier::where('user_id',$request->supplier_id)->value('cash');

        $cash = $cash + 10;

        $count = $count + 1;


        $supplierUpdate = supplier::where('user_id',$request->supplier_id)->update([
            'count' => $count,
            'rate' => $rate,
            'cash' => $cash

        ]);
    }

    public function destroyOrder($id)
    {
        $order = order::where('id',$id)->delete();
        $suppliernotf = suppliernotf::where('order_id',$id)->delete();

    }
}
