<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\subcatg;
use App\catg;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class subCatgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catgs = catg::get();
        $subCatgs = subcatg::get();
        return response()->json(['catgs' => $catgs,'subCatgs' => $subCatgs]);
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
            'catg_id' => 'required',
            'image' => 'required|image64:jpeg,jpg,png',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('images/item/');
        Image::make($request->get('image'))->resize(400,400)->save(public_path('images/subCatg/').$fileNameimage);

        $subcatg = subcatg::create([
            'title' => $request->title,
            'image' => 'images/subCatg/'.$fileNameimage,
            'catg_id' => $request->catg_id
        ]);
        return response()->json($subcatg);
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

        $subcatg = subcatg::where('id',$id)->update([
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
        Image::make($request->get('image'))->resize(400,400)->save(public_path('images/subCatg/').$fileNameimage);

        $subcatg = subcatg::where('id',$id)->update([
            'image' => 'images/subCatg/'.$fileNameimage
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
        $subcatg = subcatg::where('id',$id)->delete();
    }
}
