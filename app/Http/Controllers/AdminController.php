<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class AdminController extends Controller
{
    //costumer
    public function costumerIndex()
    {
    	return true;
    }
    public function changeStatus(Request $request)
    {
    	$transaction = Transaction::find($request->id);
    	$transaction->changeStatus($request->status);
    	return back();
    }
}
