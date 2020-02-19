<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Transaction;
use Carbon\Carbon;
class ReportsController extends Controller
{
    //
    public function index()
    {
        $table = Menu::all();
        $from = Carbon::yesterday()->toDateString();
        $to = Carbon::now()->toDateString();

        return view('admin/reports', [
            'tables'=>$table,
            'cat' => 'default',
            'start_date' => $from,
            'end_date' => $to
        ]);
    }
    public function reportDate($from, $to)
    {

        $table = Menu::all();
        return view('admin/reports', [
            'tables'=>$table,
            'cat' => 'date',
            'start_date' => $from,
            'end_date' => $to
        ]);
    }
    public function sales()
    {
        $table = Transaction::all();
        $from = Carbon::yesterday()->toDateString();
        $to = Carbon::now()->toDateString();
        return view('admin/sales', [
            'tables'=>$table,
            'start_date' => $from,
            'end_date' => $to
        ]);
    }
    public function salesDate($from, $to)
    {
        $table = Transaction::whereBetween('created_at', [$from, $to])->get();
        return view('admin/sales', [
            'tables'=>$table,
            'start_date' => $from,
            'end_date' => $to
        ]);
    }
    public function export($from, $to)
    {
        $table = Menu::all();
        Excel::create('Report', function($excel) {

            $excel->sheet('New sheet', function($sheet) {

                $sheet->loadView('excel.report', [
                    'tables'=>$table,
                    'cat' => 'date',
                    'start_date' => $from,
                    'end_date' => $to
                ]);
            });

        });
    }
}
