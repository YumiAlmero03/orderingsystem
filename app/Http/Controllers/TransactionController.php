<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Category;
use App\Order;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\ReserveValidate;
use Carbon;
use PDO;
use Hash;

class TransactionController extends Controller
{
    public function stageone(Request $request)
    {

        $transaction = Transaction::where('username', $request->username)->first();


        if ($transaction){

            if ($transaction->status == "done" || $transaction->status == "void" ) {
                $fail = 'Code is Expired';
            } else {
                if($request->pass === $transaction->pass){
                    return $this->toMenu($transaction);
                } else{
                    $fail = 'Incorrect Password';
                }
            }
        } else{
            $fail = 'Username does not exists';
        }

        return back()->with('error', $fail);
    }
    public function qrRetrive($userid,$pass,$test)
    {
        $userid = $userid;
        $pass = $pass;
        $transaction = Transaction::where('username', $userid)->first();
        if ($transaction){
            if ($pass === $transaction->pass) {
                if ($transaction->status == "done" ) {
                    $transaction->changeStatus('register');
                }
                return $this->toMenu($transaction);
            }
        }
        $fail = 'Error: Change QR';
        return view('costumer/reserve')->with('error', $fail);
    }
    public function toMenu($transaction)
    {
        if ($transaction->status === "reordering" ) {
            return $this->toReorder($transaction);
        } elseif ($transaction->status === "ordering" || $transaction->status === "register"|| $transaction->status === "reserve") {
            return $this->order($transaction);
        } elseif ($transaction->status === "done" ) {
            $fail = 'Transaction is Completed';
            return back()->with('error', $fail);
        }  elseif ($transaction->status === "recording" || $transaction->status === "cooking" || $transaction->status === "preparing" ) {
            return view('costumer/prep', ['order' => $transaction]);
        }
        return view('costumer/done', ['order' => $transaction]);
    }
    public function toReorder($transaction){
        $menus = Category::all();
        $feats = Menu::where('feat', 1)->get();
        $transaction->changeStatus('reordering');
        $reorder = 1;

        return view('costumer/menu', ['menus'=>$menus, 'id'=>$transaction, 'feats'=>$feats, 'reorder'=> $reorder]);
    }
    public function reorder(Request $request)
    {

        $transaction = Transaction::where('username', $request->username)->first();
        return $this->toReorder($transaction);
    }
    public function order($transaction)
    {
        $menus = Category::all();
        $feats = Menu::where('feat', 1)->get();
        $transaction->changeStatus('ordering');
        $reorder = 0;
        return view('costumer/menu', ['menus'=>$menus, 'id'=>$transaction, 'feats'=>$feats, 'reorder'=> $reorder]);
    }
    public function stagetwo(Request $request)
    {
        //
        $order = Transaction::find($request->order_id);
        $orders = [];
        $time = 0;
        $date = Carbon\Carbon::now();
        foreach ($request->order as $key => $value) {
            array_push($orders, $value);
            if (isset($value['id'])) {
                $test = Order::updateOrCreate(['id'=>(int)$value['id']],$value);
            } else {
                $test = Order::insert($value);
            }
            if($value['quantity'] != 0){
                $test =Menu::find($value['menu_id']);
                $time .= intval($value['quantity']) * intval($test->prepare_time);
            }
        }
        //
        $order->price = $request->price;
        $order->order_at = $date;
        $order->preptime = intval($time);
        $order->changeStatus('recording');

        return redirect()->route('prep', ['id' => $order->id]);
    }
    public function prep($id){
        $order = Transaction::find($id);
        return view('costumer/prep', ['order' => $order]);
    }
    public function stagethree($id)
    {
        //
        $order = Transaction::find($id);
        return view('costumer/done', ['order' => $order]);
    }
    public function void($id)
    {
        $trans = Transaction::find($id);
        $trans->changeStatus('void');
        return back()->with('error', 'Transaction Voided');
    }

    public function test()
    {
        return"test";
    }
}
