<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'Bar';
    protected $primaryKey = 'Id';

    protected $guarded = array();

    public $timestamps = false;
}
