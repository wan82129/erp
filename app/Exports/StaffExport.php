<?php

namespace App\Exports;

use App\Models\StaffModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class StaffExport implements FromCollection
{
    protected $columns;

    public function __construct($columns) {
        $this->columns = $columns;
    }

    public function collection()
    {
        return StaffModel::select($this->columns)->get();
    }
}