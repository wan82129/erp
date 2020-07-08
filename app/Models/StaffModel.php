<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'Staff';
    protected $primaryKey = 'Id';

    public $timestamps = false;
    
    public function StaffAccessLevel()
    {
        return $this->hasOne(
            'App\Models\StaffAccessLevelModel',
            'Id', //foreign
            'AccessLevelId' //local
        );
    }
}
