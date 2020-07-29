<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'Customer';
    protected $primaryKey = 'Id';

    protected $guarded = array();

    public $timestamps = false;
}
