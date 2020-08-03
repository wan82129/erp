<?php

namespace App\Exports;

use App\Models\BarModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarExport implements FromCollection
{
    protected $columns;

    public function __construct($columns) {
        $this->columns = $columns;
    }

    public function collection()
    {
        return BarModel::select($this->columns)->get();
    }
}