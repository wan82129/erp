<?php

namespace App\Exports;

use App\Models\FoodModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class FoodExport implements FromCollection
{
    protected $columns;

    public function __construct($columns) {
        $this->columns = $columns;
    }

    public function collection()
    {
        return FoodModel::select($this->columns)->get();
    }
}