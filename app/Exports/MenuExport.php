<?php

namespace App\Exports;

use App\Menu;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MenuExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(array $menus)
    {
        $this->menus = $menus;
    }
    public function array(): array
    {
        return $this->menus;
    }
    public function view(): View
    {
        return view('export.report', $this->menus);
    }
}
