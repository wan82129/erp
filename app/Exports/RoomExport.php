<?php

namespace App\Exports;

use App\Models\RoomModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class RoomExport implements FromCollection
{
    protected $columns;

    public function __construct($columns) {
        $this->columns = $columns;
    }

    public function collection()
    {
        return RoomModel::select($this->columns)->get();
    }
}