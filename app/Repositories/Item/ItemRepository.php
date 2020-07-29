<?php

namespace App\Repositories\Item;

use Carbon\Carbon;

use App\Models\StaffModel;
use App\Models\CustomerModel;

class ItemRepository
{
    public function __construct(StaffModel $staffModel, CustomerModel $customerModel)
    {
        $this->StaffModel = $staffModel;
        $this->CustomerModel = $customerModel;
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
        $result = $this->StaffModel::create($staff);

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
     * delete staff
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

    /**
     * get customer
     *
     */
    public function getCustomer($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $filter = '%'.$filter.'%';

        $result = $this->CustomerModel
            ->where('Status', 'Use')
            ->where(function ($query) use ($filter) {
                $query->where('Code', 'LIKE', $filter)
                      ->orWhere('Name', 'LIKE', $filter);
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
    public function getCustomerCount()
    {
        $result = $this->CustomerModel::count();

        return $result;
    }

    /**
     * add customer
     *
     */
    public function addCustomer($customer)
    {
        $result = $this->CustomerModel::create($customer);

        return $result;
    }

    /**
     * edit customer
     *
     */
    public function editCustomer($customer)
    {
        $result = $this->CustomerModel::find($customer['Id']);

        $result->Code = $customer['Code'];
        $result->Name = $customer['Name'];
        $result->Birthday = $customer['Birthday'];
        $result->Credit = $customer['Credit'];
        $result->Company = $customer['Company'];
        $result->IsOpenReceipt = $customer['IsOpenReceipt'];
        $result->ReceiptTitle = $customer['ReceiptTitle'];
        $result->ReceiptAddress = $customer['ReceiptAddress'];
        $result->GetPaidAddress = $customer['GetPaidAddress'];
        $result->Contactor = $customer['Contactor'];
        $result->TaxNumber = $customer['TaxNumber'];
        $result->Phone = $customer['Phone'];
        $result->Note = $customer['Note'];
        $result->ReleaseOrderDate = $customer['ReleaseOrderDate'];
        $result->GetPaidDate = $customer['GetPaidDate'];
        $result->ClearLog = $customer['ClearLog'];
        $result->PreUpdatedTime = $customer['UpdatedTime'];
        $result->UpdatedTime = Carbon::now()->toDateString();
        $result->LatestConsumpDate = $customer['LatestConsumpDate'];
        $result->StaffCode  = $customer['StaffCode'];
        $result->CustomerType = $customer['CustomerType'];

        $result->save();

        return $result;
    }

    /**
     * delete customer
     *
     */
    public function deleteCustomer($id)
    {
        $customer = $this->CustomerModel::find($id);

        $customer->Status = 'Delete';
        $customer->PreUpdatedTime = $customer->UpdatedTime;
        $customer->UpdatedTime = Carbon::now()->toDateString();

        $customer->save();

        return $customer;
    }

    /**
     * get staff by code
     */
    public function getStaffByCode($code)
    {
        $staff = $this->StaffModel
            ->where('Code', $code)
            ->first();

        return $staff;
    }
}
