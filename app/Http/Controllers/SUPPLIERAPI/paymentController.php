<?php

namespace App\Http\Controllers\SUPPLIERAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\payment;
class paymentController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
            'amount' => 'required'
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 


        if($request->get('image')) {
	    	$image = $request->get('image');
	        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
	        Image::make($request->get('image'))->save(public_path('images/payment/').$fileNameimage);
	        $image = 'images/payment/'.$fileNameimage;
        	}
        $payment = payment::create([
        	'amount' => $request->amount,
        	'msg' => $request->msg,
        	'image' => $image,
        	'user_id' => Auth::id()
        ]);
    } 

    public function index() 
    {
    	return response()->json(payment::where('user_id',Auth::id())->get());
    }
}
