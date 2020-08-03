<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemParametersModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'SystemParameters';
    protected $primaryKey = 'Id';

    protected $guarded = array();

    public $timestamps = false;
}
