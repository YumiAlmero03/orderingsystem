<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Table;
use Response;
class ApiController extends Controller
{
    //
    public function costumerStatus($id)
    {
    	$data = Transaction::find($id);
    	$stats = $data->status;	
    	return response()->json([$stats]);
    }
    public function getCostumers()
    {
    	return response(Table::all()->jsonSerialize());
    }
    public function getCostumer($id)
    {
    	return response(Transaction::find($id)->toJSON());
    }
}
