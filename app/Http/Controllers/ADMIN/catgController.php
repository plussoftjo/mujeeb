<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\catg;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class catgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(catg::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'image' => 'required|image64:jpeg,jpg,png',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/item/');
        Image::make($request->get('image'))->save(public_path('images/catg/').$fileNameimage);

        $catg = catg::create([
            'title' => $request->title,
            'image' => 'images/catg/'.$fileNameimage
        ]);
        return response()->json($catg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [ 
            'title' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $catg = catg::where('id',$id)->update([
            'title' => $request->title
        ]);
    }

    public function updateImage(Request $request,$id) 
    {
         $validator = Validator::make($request->all(), [ 
            'image' => 'required|image64:jpeg,jpg,png',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/item/');
        Image::make($request->get('image'))->resize(100,300)->save(public_path('images/catg/').$fileNameimage);

        $catg = catg::where('id',$id)->update([
            'image' => 'images/catg/'.$fileNameimage
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catg = catg::where('id',$id)->delete();
    }
}
