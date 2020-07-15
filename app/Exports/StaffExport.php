<?php

namespace App\Exports;

use App\Models\StaffModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class StaffExport implements FromCollection
{
    public function collection()
    {
        return StaffModel::all();
    }
}