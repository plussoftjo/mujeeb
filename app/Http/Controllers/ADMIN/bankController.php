<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bankaccount;
use Validator;
class bankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankaccount = bankaccount::get();

        return response()->json($bankaccount);
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
            'account_number' => 'required', 
            'bank_name' => 'required', 
            'place' => 'required', 
            'account_name' => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 

         $bankaccount = bankaccount::create([
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'place' => $request->place,
            'account_name' => $request->account_name
        ]);
        return response()->json($bankaccount);
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
            'account_number' => 'required', 
            'bank_name' => 'required', 
            'place' => 'required', 
            'account_name' => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 


        $bankaccount = bankaccount::where('id',$id)->update([
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'place' => $request->place,
            'account_name' => $request->account_name
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
        $bankaccount = bankaccount::where('id',$id)->delete();
    }
}
