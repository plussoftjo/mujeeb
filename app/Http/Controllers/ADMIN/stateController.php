<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class stateController extends Controller
{
    public function dashboard() 
    {
    	$client_count = User::where('type','customer')->count();
    	$supplier_count = User::where('type','مؤسسة')->count();

    	return response()->json(['client_count' => $client_count,'supplier_count' => $supplier_count]);
    }
}
