<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\feedback;
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
    		'lngLat' => $request->lngLat,
    		'des' => $request->note,
    		'images' => $images,
    		'type' => 'direct',
    		'catg_id' => $request->catg_id,
    		'subcatg_id' => $request->service

    	]);	
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
    }

    public function destroyOrder($id)
    {
        $order = order::where('id',$id)->update([
            'state' => 3
        ]);
    }
}
