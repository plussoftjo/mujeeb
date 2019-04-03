<?php

namespace App\Http\Controllers\SUPPLIERAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\country;
use App\catg;
use App\city;
use App\subcity;
use App\subcatg;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\supplier;
use App\supplierreview;
class authController extends Controller
{
    public function fetch() {
    	return response()->json(User::where('id',Auth::id())->first());
    }

    public function fetchdata() {
    	$countrys = country::get();
    	$catgs = catg::get();
    	return response()->json(['countrys' => $countrys,'catgs' => $catgs]);
    }
    public function changeCountry($id) {
    	return response()->json(city::where('country_id',$id)->get());
    } 
    public function changeCity($id)
    {
    	return response()->json(subcity::where('city_id',$id)->get());
    } 

    public function changeCatg(Request $request) 
    {
    	 $ids = explode(',', $request->catg);
    	 $result = array();
    	 foreach ($ids as $k) {
            $result[] = subcatg::where('catg_id',$k)->get();
        }
        return response()->json($result);
    }

    public function store(Request $request) 
    {
    	$validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required', 
            'password' => 'required', 
            'type' => 'required', 
            'country_id' => 'required', 
            'city_id' => 'required', 
            'subcity_id' => 'required', 
            'catg_id' => 'required', 
            'image' => 'required|image64:jpeg,jpg,png',
        ]);

         if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/supplier/').$fileNameimage);

         $user = User::create([
        	'name' => $request->name,
        	'phone' => $request->phone,
        	'password' => bcrypt($request->password),
        	'type' => $request->type,
        ]);

        $supplier = supplier::create([
        	'user_id' => $user->id,
        	'country_id' => $request->country_id,
        	'city_id' => $request->city_id,
        	'subcity_id' => $request->subcity_id,
        	'catg_id' => $request->catg_id,
        	'subcatg_id' => $request->subcatg_id,
            'image' => 'images/supplier/'.$fileNameimage,
            'nationality' => $request->nationality,
            'gender' => $request->gender
        ]);


        $image = $request->get('imageI');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('imageI'))->save(public_path('images/review/').$fileNameimage);


        $supplierreview = supplierreview::create([
            'user_id' => $user->id,
            'image' => 'images/review/'.$fileNameimage,
            'title' => $request->msg
        ]);

        return response()->json(['user' => $user,'supplier' => $supplier]);
    }

    public function check() {
        $approve = User::where('id',Auth::id())->value('approved');
        if($approve) {
            return response()->json(['approve' => true]);
        }
        return response()->json(['approve' => false]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required', 
        ]);

         if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $user = User::where('id',$request->id)->update([
            'name'=> $request->name,
            'phone' => $request->phone
        ]);
    }

}
