<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'Food';
    protected $primaryKey = 'Id';

    protected $guarded = array();

    public $timestamps = false;
}
