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
     * add staff
     *
     */
    public function addStaff($code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $isActive)
    {
        $staff = $this->StaffModel::create([
            'Code' => $code,
            'Name' => $name,
            'NickName' => $nickName,
            'SerialNumber' => $serialNumber,
            'AccessLevelId' => $accessLevelId,
            'Phone' => $phone,
            'Birthday' => $birthday,
            'IsActive' => $isActive
        ]);

        return $staff;
    }

    /**
     * edit staff
     *
     */
    public function editStaff($id, $code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $isActive)
    {
        $staff = $this->StaffModel::find($id);

        $staff->Code = $code;
        $staff->Name = $name;
        $staff->NickName = $nickName;
        $staff->SerialNumber = $serialNumber;
        $staff->AccessLevelId = $accessLevelId;
        $staff->Phone = $phone;
        $staff->Birthday = $birthday;
        $staff->IsActive = $isActive;

        $staff->save();

        return $staff;
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
