<?php

namespace App\Repositories\Item;

use Carbon\Carbon;

use App\Models\StaffModel;

class ItemRepository
{
    public function __construct(StaffModel $staffModel)
    {
        $this->StaffModel = $staffModel;
    }

    /**
     * get staff
     *
     */
    public function getStaff($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $filter = '%'.$filter.'%';

        $result = $this->StaffModel
            ->where('Status', 'Use')
            ->where(function ($query) use ($filter) {
                $query->where('Code', 'LIKE', $filter)
                      ->orWhere('Name', 'LIKE', $filter)
                      ->orWhere('RealName', 'LIKE', $filter)
                      ->orWhere('NickName', 'LIKE', $filter)
                      ->orWhere('AccessLevel', 'LIKE', $filter);
            })
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
    public function addStaff($staff)
    {
        $result = $this->StaffModel::create([
            'Code' => $staff['Code'],
            'Name' => $staff['Name'],
            'RealName' => $staff['RealName'],
            'NickName' => $staff['NickName'],
            'SerialNumber' => $staff['SerialNumber'],
            'AccessLevel' => $staff['AccessLevel'],
            'Phone' => $staff['Phone'],
            'Birthday' => $staff['Birthday'],
            'ContactAddress' => $staff['ContactAddress'],
            'ResidenceAddress' => $staff['ResidenceAddress'],
            'Note' => $staff['Note'],
            'IsDisable' => $staff['IsDisable'],
            'ArrivedDate' => $staff['ArrivedDate'],
            'LeavedDate' => $staff['LeavedDate'],
            'Manager' => $staff['Manager'],
            'FileType' => $staff['FileType'],
            'UpdatedTime' => Carbon::now()->toDateString(),
            'StaffSalaryType' => $staff['StaffSalaryType'],
            'LadySalaryType' => $staff['LadySalaryType'],
            'ShowColumn' => $staff['ShowColumn'],
            'CardNumber' => $staff['CardNumber'],
            'SalaryPerDay' => $staff['SalaryPerDay'],
            'Liability' => $staff['Liability'],
            'BarFeeType' => $staff['BarFeeType'],
            'BrokerageFeePerDay' => $staff['BrokerageFeePerDay'],
            'BrokerageFeePerSection' => $staff['BrokerageFeePerSection'],
            'CleaningFee' => $staff['CleaningFee'],
            'SectionPerDay' => $staff['SectionPerDay'],
            'SectionCost1' => $staff['SectionCost1'],
            'SectionCost2' => $staff['SectionCost2'],
            'TakeBarFee' => $staff['TakeBarFee']
        ]);

        return $result;
    }

    /**
     * edit staff
     *
     */
    public function editStaff($staff)
    {
        $result = $this->StaffModel::find($staff['Id']);

        $result->Code = $staff['Code'];
        $result->Name = $staff['Name'];
        $result->RealName = $staff['RealName'];
        $result->NickName = $staff['NickName'];
        $result->SerialNumber = $staff['SerialNumber'];
        $result->AccessLevel = $staff['AccessLevel'];
        $result->Phone = $staff['Phone'];
        $result->Birthday = $staff['Birthday'];
        $result->ContactAddress = $staff['ContactAddress'];
        $result->ResidenceAddress = $staff['ResidenceAddress'];
        $result->Note = $staff['Note'];
        $result->IsDisable = $staff['IsDisable'];
        $result->ArrivedDate = $staff['ArrivedDate'];
        $result->LeavedDate = $staff['LeavedDate'];
        $result->Manager = $staff['Manager'];
        $result->FileType = $staff['FileType'];
        $result->UpdatedTime = Carbon::now()->toDateString();
        $result->StaffSalaryType = $staff['StaffSalaryType'];
        $result->LadySalaryType = $staff['LadySalaryType'];
        $result->ShowColumn = $staff['ShowColumn'];
        $result->CardNumber = $staff['CardNumber'];
        $result->SalaryPerDay = $staff['SalaryPerDay'];
        $result->Liability = $staff['Liability'];
        $result->BarFeeType = $staff['BarFeeType'];
        $result->BrokerageFeePerDay = $staff['BrokerageFeePerDay'];
        $result->BrokerageFeePerSection = $staff['BrokerageFeePerSection'];
        $result->CleaningFee = $staff['CleaningFee'];
        $result->SectionPerDay = $staff['SectionPerDay'];
        $result->SectionCost1 = $staff['SectionCost1'];
        $result->SectionCost2 = $staff['SectionCost2'];
        $result->TakeBarFee = $staff['TakeBarFee'];

        $result->save();

        return $result;
    }

    /**
     * edit staff
     *
     */
    public function deleteStaff($id)
    {
        $staff = $this->StaffModel::find($id);

        $staff->Status = 'Delete';
        $staff->UpdatedTime = Carbon::now()->toDateString();

        $staff->save();

        return $staff;
    }
}
