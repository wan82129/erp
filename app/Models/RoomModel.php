<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'Room';
    protected $primaryKey = 'Id';

    protected $guarded = array();

    public $timestamps = false;
}
