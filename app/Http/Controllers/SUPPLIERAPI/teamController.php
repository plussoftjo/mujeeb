<?php

namespace App\Http\Controllers\SUPPLIERAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\team;
use App\supplier;
use Validator;
use App\subcatg;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\order;
class teamController extends Controller
{
    public function fetchSubcatg() 
    {
    	$subcatg_ids = supplier::where('user_id',Auth::id())->value('subcatg_id');
    	$ids = explode(',', $subcatg_ids);
    	$subcatg = subcatg::whereIn('id',$ids)->get();
    	return response()->json($subcatg);
    }

    public function store(Request $request) 
    {
    	$validator = Validator::make($request->all(), [ 
            'name' => 'required'
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 

        if($request->get('image')) {
        	$image = $request->get('image');
            $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/team/').$fileNameimage);

            $image = 'images/team/'.$fileNameimage;
        }else {
        	$image = 'images/team/avatar.jpg';
        }

        //get Supplier ID 
        $supplier_id = supplier::where('user_id',Auth::id())->value('id');

        $team = team::create([
        	'supplier_id' => $supplier_id,
        	'name' => $request->name,
        	'subcatg_id' => $request->subcatg_id,
        	'image' => $image
        ]);
        return response()->json($team);
    }

    public function index() 
    {
    	$supplier_id = supplier::where('user_id',Auth::id())->value('id');
    	return response()->json(team::where('supplier_id',$supplier_id)->get());
    }

    public function person($id) {
        $orders = order::where('team_id',$id)->where('state',2)->get();
        $team = team::where('id',$id)->first();
        return response()->json(['orders' => $orders,'team' => $team]);
    }
}