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
    public function getStaff($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $filter = '%'.$filter.'%';

        $result = $this->StaffModel
            ->with('StaffAccessLevel')
            ->where('Status', 'Use')
            ->where(function ($query) use ($filter) {
                $query->where('Code', 'LIKE', $filter)
                      ->orWhere('Name', 'LIKE', $filter);
            })
            ->where('Code', 'Like', $filter)
            ->orWhere('Name', 'Like', $filter)
            ->orderBy($sortBy, $sortDirection)
            ->orderBy('UpdatedTime', 'DESC')
            ->skip(($currentPage - 1) * $perPage)->take($perPage)
            ->get();

        return $result;
    }

    /**
     * get staff count
     *
     */
    public function getStaffCount()
    {
        $result = $this->StaffModel::count();

        return $result;
    }


    /**
     * add staff
     *
     */
    public function addStaff($code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $contact, $residence, $note, $isActive, $arrived, $leaved)
    {
        $staff = $this->StaffModel::create([
            'Code' => $code,
            'Name' => $name,
            'NickName' => $nickName,
            'SerialNumber' => $serialNumber,
            'AccessLevelId' => $accessLevelId,
            'Phone' => $phone,
            'Birthday' => $birthday,
            'ContactAddress' => $contact,
            'ResidenceAddress' => $residence,
            'Note' => $note,
            'IsActive' => $isActive,
            'ArrivedDate' => $arrived,
            'LeavedDate' => $leaved
        ]);

        return $staff;
    }

    /**
     * edit staff
     *
     */
    public function editStaff($id, $code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $contact, $residence, $note, $isActive, $arrived, $leaved)
    {
        $staff = $this->StaffModel::find($id);

        $staff->Code = $code;
        $staff->Name = $name;
        $staff->NickName = $nickName;
        $staff->SerialNumber = $serialNumber;
        $staff->AccessLevelId = $accessLevelId;
        $staff->Phone = $phone;
        $staff->Birthday = $birthday;
        $staff->ContactAddress = $contact;
        $staff->ResidenceAddress = $residence;
        $staff->Note = $note;
        $staff->IsActive = $isActive;
        $staff->ArrivedDate = $arrived;
        $staff->LeavedDate = $leaved;

        $staff->save();

        return $staff;
    }

    /**
     * edit staff
     *
     */
    public function deleteStaff($id)
    {
        $staff = $this->StaffModel::find($id);

        $staff->Status = 'Delete';

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
