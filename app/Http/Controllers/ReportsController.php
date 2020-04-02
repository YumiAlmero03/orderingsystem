<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Transaction;
use Carbon\Carbon;
use App\Exports\MenuExport;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $from = Carbon::yesterday()->toDateString();
        $to = Carbon::now()->addHours(23)->toDateString();
        $table = Transaction::whereBetween('created_at', [$from, $to])->get();
        return view('admin/sales', [
            'tables'=>$table,
            'start_date' => $from,
            'end_date' => $to
        ]);
    }
    public function salesDate($from, $to)
    {
        $to = Carbon::parse($to)->addHours(23)->toDateString();
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
        $export = new MenuExport([
            'tables'=>$table,
            'cat' => 'date',
            'start_date' => $from,
            'end_date' => $to
        ]);
        return Excel::download($export, 'reports '.$from.' to '. $to.'.xlsx');
    }
    public function salesExport($from, $to)
    {
        $to = Carbon::parse($to)->addHours(23)->toDateString();
        $table = Transaction::whereBetween('created_at', [$from, $to])->get();
        $export = new SalesExport([
            'tables'=>$table,
            'cat' => 'date',
            'start_date' => $from,
            'end_date' => $to
        ]);
        return Excel::download($export, 'sales '.$from.' to '. $to.'.xlsx');
    }
}
