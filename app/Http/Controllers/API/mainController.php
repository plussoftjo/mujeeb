<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\catg;
use App\User;
use App\supplier;
use App\subcatg;
use Auth;
use App\country;
use App\city;
use App\subcity;
use App\profile;
use Validator;
class mainController extends Controller
{
    public function services() {
    	return response()->json(catg::get());
    }

    // GET SERVIVCE WITH ID 
    public function fetchService($id) 
    {
    	$suppliers = supplier::where('catg_id','like','%'.$id.'%')->pluck('user_id');
    	$users = User::whereIn('id',$suppliers)->get();
    	return $users;
    }

    public function getSubservice($id) 
    {
        $subCatg = subcatg::where('catg_id',$id)->get();
        return response()->json($subCatg);
    }

    public function checkProfile() {
        $profile = profile::where('user_id',Auth::id())->firstOrFail();
        return response()->json();
    }

    public function changeCountry($id)
    {
        $city = city::where('country_id',$id)->get();
        return response()->json($city);
    }

    public function changeCity($id)
    {
        $subcity = subcity::where('city_id',$id)->get();
        return response()->json($subcity);
    }

    public function getCountry() {
        return response()->json(country::get());
    }

    public function saveProfile(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 
            'country' => 'required', 
            'city' => 'required', 
            'subcity' => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 

        $profile = profile::create([
            'country_id' => $request->country,
            'city_id' => $request->city,
            'subcity_id' => $request->subcity,
            'user_id' => Auth::id() 
        ]);

        return response()->json($profile);
    }
}
