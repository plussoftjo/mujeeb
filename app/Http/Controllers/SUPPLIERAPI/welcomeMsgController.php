<?php

namespace App\Http\Controllers\SUPPLIERAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\welcomemsg;
use Auth;
class welcomeMsgController extends Controller
{
    public function check() 
    {
    	$msg = welcomemsg::where('user_id',Auth::id())->count();
    	if($msg == 0)
    	{
    		return response()->json(['hasMsg' => false]);
    	}else{
    		$msg = welcomemsg::where('user_id',Auth::id())->value('msg');
    		return response()->json(['hasMsg' => true,'msg' => $msg]);
    	}
    }
    public function store(Request $request)
    {
    	$msg = welcomemsg::create([
    		'user_id' => Auth::id(),
    		'msg' => $request->msg
    	]);
    }
    public function update(Request $request) {
    	$msg = welcomemsg::where('user_id',Auth::id())->update([
    		'msg' => $request->msg
    	]);
    }
}
