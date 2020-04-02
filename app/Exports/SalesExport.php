<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }
    public function array(): array
    {
        return $this->transactions;
    }
    public function view(): View
    {
        return view('export.sale', $this->transactions);
    }
}
