<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'Staff';
    protected $primaryKey = 'Id';

    protected $guarded = array();

    public $timestamps = false;
}
