<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ads;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;

class adsController extends Controller
{
    public function index() {
    	return response()->json(ads::get());
    }

    public function store(Request $request) {
    	$validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'image' => 'required|image64:jpeg,jpg,png',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/ads/').$fileNameimage);

        $ads = ads::create([
            'title' => $request->title,
            'image' => 'images/ads/'.$fileNameimage
        ]);

        return response()->json($ads);
    }

    public function destroy($id)
    {
        $ads = ads::where('id',$id)->delete();
    }
}
