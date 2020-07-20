<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'Staff';
    protected $primaryKey = 'Id';
    protected $fillable = ['Code', 'Name', 'RealName', 'NickName', 'SerialNumber', 'AccessLevel', 'Phone', 'Birthday', 'ContactAddress', 'ResidenceAddress', 'Note', 'IsDisable', 'ArrivedDate', 'LeavedDate', 'Manager', 'FileType'];

    public $timestamps = false;
}
