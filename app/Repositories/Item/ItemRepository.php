<?php

namespace App\Repositories\Item;

use App\Models\StaffModel;
use App\Models\StaffAccessLevelModel;

class ItemRepository
{
    public function __construct(StaffModel $staffModel, StaffAccessLevelModel $staffAccessLevelModel)
    {
        $this->StaffModel = $staffModel;
        $this->StaffAccessLevelModel = $staffAccessLevelModel;
    }

    /**
     * get staff
     *
     */
    public function getStaff()
    {
        $result = $this->StaffModel
            ->with('StaffAccessLevel')
            ->get();

        return $result;
    }

    /**
     * get staff access level
     *
     */
    public function getStaffAccessLevel()
    {
        $result = $this->StaffAccessLevelModel::All();

        return $result;
    }
}
