<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Table;
use App\Demand;
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
        $res = [];
        $tables = Table::all();
        foreach ($tables as $table) {
            $table = ['table' => $table];
            array_push($res, $table);
        }
    	return response()->json($res);
    }
    public function getRequest()
    {
        return Demand::all()->toJSON();
    }
    public function getCostumer($id)
    {
    	return response(Transaction::find($id)->toJSON());
    }
}
