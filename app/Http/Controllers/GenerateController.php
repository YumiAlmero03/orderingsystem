<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use QrCode;
use App\Transaction;
use App\Table;
use App\Menu;
use App\Category;
use Carbon\Carbon;

class GenerateController extends Controller
{

    public function display()
    {

    	$username = Carbon::now()->format('mdhs');
        $pass = Category::randomName();
        $table = Table::available()->id;
        $transaction = Transaction::create([
            'username'=> $username,
            'pass'=> Hash::make($pass),
            'status'=> 'reserve',
            'table_id'=> $table
        ]);
    	$qr = QrCode::size(100)->generate(env('APP_URL').'/qrto/'.encrypt($username).'/'.encrypt($pass));
    	return view('generate.qr', [
    		'qr' => $qr,
    		'transaction'=>$transaction,
    		'password'=>$pass
    	]);
    }
    public function print()
    {
        $fp=pfsockopen("192.168.1.33", 9100);
        fputs($fp, $print_output);
        fclose($fp);
        return "success";
    }
}
