<?php

namespace App\Repositories\Item;

use Carbon\Carbon;

use App\Models\StaffModel;
use App\Models\CustomerModel;
use App\Models\RoomModel;
use App\Models\FoodModel;
use App\Models\BarModel;

class ItemRepository
{
    public function __construct(StaffModel $staffModel, CustomerModel $customerModel, RoomModel $roomModel, FoodModel $foodModel, BarModel $barModel)
    {
        $this->StaffModel = $staffModel;
        $this->CustomerModel = $customerModel;
        $this->RoomModel = $roomModel;
        $this->FoodModel = $foodModel;
        $this->BarModel = $barModel;
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

    /**
     * get room
     *
     */
    public function getRoom($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $filter = '%'.$filter.'%';

        $result = $this->RoomModel
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
     * get room count
     *
     */
    public function getRoomCount()
    {
        $result = $this->RoomModel::count();

        return $result;
    }


    /**
     * add room
     *
     */
    public function addRoom($room)
    {
        $result = $this->RoomModel::create($room);

        return $result;
    }

    /**
     * edit room
     *
     */
    public function editRoom($room)
    {
        $result = $this->RoomModel::find($room['Id']);

        $result->Code = $room['Code'];
        $result->Name = $room['Name'];
        $result->LimitCount = $room['LimitCount'];
        $result->MorningPrice = $room['MorningPrice'];
        $result->NightPrice = $room['NightPrice'];
        $result->TimeoutPrice = $room['TimeoutPrice'];
        $result->Level = $room['Level'];
        $result->HaveDefaultOpeningFood = $room['HaveDefaultOpeningFood'];
        $result->Note = $room['Note'];
        $result->UpdatedTime = Carbon::now()->toDateString();

        $result->save();

        return $result;
    }

    /**
     * delete room
     *
     */
    public function deleteRoom($id)
    {
        $room = $this->RoomModel::find($id);

        $room->Status = 'Delete';
        $room->UpdatedTime = Carbon::now()->toDateString();

        $room->save();

        return $room;
    }

    /**
     * get food
     *
     */
    public function getFood($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $filter = '%'.$filter.'%';

        $result = $this->FoodModel
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
     * get food count
     *
     */
    public function getFoodCount()
    {
        $result = $this->FoodModel::count();

        return $result;
    }


    /**
     * add food
     *
     */
    public function addFood($food)
    {
        $result = $this->FoodModel::create($food);

        return $result;
    }

    /**
     * edit food
     *
     */
    public function editFood($food)
    {
        $result = $this->FoodModel::find($food['Id']);

        $result->Code = $food['Code'];
        $result->Name = $food['Name'];
        $result->Count = $food['Count'];
        $result->Type = $food['Type'];
        $result->IsDefaultOpeningFood = $food['IsDefaultOpeningFood'];
        $result->DefaultOpeningFoodCountPerRoomType = $food['DefaultOpeningFoodCountPerRoomType'];
        $result->IsFreeService = $food['IsFreeService'];
        $result->WineType = $food['WineType'];
        $result->SelfHelpPrice = $food['SelfHelpPrice'];
        $result->Price = $food['Price'];
        $result->PremiumPrice = $food['PremiumPrice'];
        $result->SafeCount = $food['SafeCount'];
        $result->Note = $food['Note'];
        $result->IsCount = $food['IsCount'];
        $result->CurrentCount = $food['CurrentCount'];
        $result->LatestPurchaseDate = $food['LatestPurchaseDate'];
        $result->PurchasePrice = $food['PurchasePrice'];
        $result->PurchaseCompany = $food['PurchaseCompany'];
        $result->IsScore = $food['IsScore'];
        $result->IsLowestThershold = $food['IsLowestThershold'];
        $result->IsTurnover = $food['IsTurnover'];
        $result->UpdatedTime = Carbon::now()->toDateString();

        $result->save();

        return $result;
    }

    /**
     * delete food
     *
     */
    public function deleteFood($id)
    {
        $food = $this->FoodModel::find($id);

        $food->Status = 'Delete';
        $food->UpdatedTime = Carbon::now()->toDateString();

        $food->save();

        return $food;
    }

    /**
     * get bar
     *
     */
    public function getBar($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $filter = '%'.$filter.'%';

        $result = $this->BarModel
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
     * get bar count
     *
     */
    public function getBarCount()
    {
        $result = $this->BarModel::count();

        return $result;
    }


    /**
     * add bar
     *
     */
    public function addBar($bar)
    {
        $result = $this->BarModel::create($bar);

        return $result;
    }

    /**
     * edit bar
     *
     */
    public function editBar($bar)
    {
        $result = $this->BarModel::updateOrCreate(
            ['Id' => $bar['Id']],
            $bar
        );

        return $result;
    }

    /**
     * delete bar
     *
     */
    public function deleteBar($id)
    {
        $bar = $this->BarModel::find($id);

        $bar->Status = 'Delete';
        $bar->UpdatedTime = Carbon::now()->toDateString();

        $bar->save();

        return $bar;
    }
}
