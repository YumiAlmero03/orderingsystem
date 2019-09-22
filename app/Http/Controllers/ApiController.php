<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class ApiController extends Controller
{
    //
    public function costumerStatus($id)
    {
    	$data = Transaction::find($id);
    	$stats = $data->status;	
    	return response()->json([$stats]);
    }
}
