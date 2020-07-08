<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffAccessLevelModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'StaffAccessLevel';
    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(
            'App\Models\StaffModel',
            'AccessLevelId', //foreign
            'Id' //local
        );
    }
}
