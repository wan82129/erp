<?php

namespace App\Exports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
{
    protected $columns;

    public function __construct($columns) {
        $this->columns = $columns;
    }

    public function collection()
    {
        return CustomerModel::select($this->columns)->get();
    }
}