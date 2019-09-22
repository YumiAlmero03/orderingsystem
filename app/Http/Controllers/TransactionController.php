<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Category;
use App\Order;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\ReserveValidate;

class TransactionController extends Controller
{
    
    public function stageone(ReserveValidate $request)
    {
         $tran = Transaction::where('username', $request->username);
        if ($tran->exists()){
            if (decrypt($tran->first()->pass) == $request->pass) {
                $menus = Category::all();
                $feats = Menu::where('feat', 1)->get();
                // dd($feats);
                $transaction = Transaction::where('username', $request->username)->first();
                $transaction->changeStatus('ordering');
                if ($transaction->status == "recording" ) {
                    return view('costumer/prep', ['order' => $transaction]);
                } elseif ($transaction->status == "done" ) {
                    $fail = 'Transaction is Completed';
                }
                return view('costumer/menu', ['menus'=>$menus, 'id'=>$transaction, 'feats'=>$feats]);
            }
            $fail = 'Incorrect Password';
        } else {
            $fail = 'Username does not exists';
        }
        return back()->with('error', $fail);
    }

    public function reorder(Request $request)
    {
        $menus = Category::all();
        $transaction = Transaction::find($request->id);
        $feats = Menu::where('feat', 1)->get();
        $transaction->changeStatus('reordering');
        return view('costumer/menu', ['menus'=>$menus, 'id'=>$transaction, 'feats'=>$feats]);
    }

    public function stagetwo(Request $request)
    {
        //
        $order = Transaction::find($request->order_id);
        $orders = [];
        foreach ($request->order as $key => $value) {
            array_push($orders, $value);
        }
        Order::insert($orders);
        //dd($order->order);
        //$order->orders = $orders;

        $order->price = $request->price;
        $order->changeStatus('recording');
        return view('costumer/prep', ['order' => $order]);
    }
    
}
