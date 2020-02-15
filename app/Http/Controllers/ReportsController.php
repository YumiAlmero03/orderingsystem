<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Transaction;
use Carbon;
class ReportsController extends Controller
{
    //
    public function index()
    {
        return view('admin/reports', ['tables'=>Menu::all(), 'cat' => 'default']);
    }
    public function reportDate($cat, $date)
    {

        $table = Menu::all();
        return view('admin/reports', ['tables'=>$table, 'cat' => $cat, 'date' => $date]);
    }
    public function sales()
    {
        return view('admin/sales', ['tables'=>Transaction::all()]);
    }
}
