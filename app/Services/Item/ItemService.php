<?php

namespace App\Services\Item;

use App\Repositories\Item\ItemRepository;

class ItemService
{
    protected $ItemRepository;

    private $perPage = 20;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->ItemRepository = $itemRepository;
    }

    /**
     * 取得staff後整理資料
     */
    public function getStaff($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $staffs = $this->ItemRepository->getStaff($sortBy, $sortDirection, $currentPage, $perPage, $filter);
        if ($filter == '') {
            $staffsCount = $this->ItemRepository->getStaffCount();
        }
        else {
            $staffsCount = $staffs->count();
        }

        $result = $staffs->transform(function($item, $key) {
            if ($item['IsActive'] == 1) {
                $IsActive = '是';
            }
            else {
                $IsActive = '否';
            }
            return [
                'Id' => $item['Id'],
                'Code' => $item['Code'],
                'Name' => $item['Name'],
                'NickName' => $item['NickName'],
                'SerialNumber' => $item['SerialNumber'],
                'AccessLevelId' => $item['AccessLevelId'],
                'AccessLevelText' => $item->StaffAccessLevel->Text,
                'Phone' => $item['Phone'],
                'Birthday' => $item['Birthday'],
                'ContactAddress' => $item['ContactAddress'],
                'ResidenceAddress' => $item['ResidenceAddress'],
                'Note' => $item['Note'],
                'IsActive' => $IsActive,
                'ArrivedDate' => $item['ArrivedDate'],
                'LeavedDate' => $item['LeavedDate'],
            ];
        });

        if ($sortDirection == 'desc') {
            $sortDesc = true;
        }
        else {
            $sortDesc = false;
        }

        $collection = collect([
            'items' => $result,
            'sortBy' => $sortBy,
            'sortDesc' => $sortDesc,
            'currentPage' => $currentPage,
            'perPage' => $this->perPage,
            'totalRows' => $staffsCount,
            'filter' => $filter
        ]);

        return $collection;
    }

    /**
     * 新增staff
     */
    public function addStaff($code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $contact, $residence, $note, $isActive, $arrived, $leaved)
    {
        if ($isActive == '是') {
            $isActive = '1';
        }
        else {
            $isActive = '0';
        }

        $result = $this->ItemRepository->addStaff($code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $contact, $residence, $note, $isActive, $arrived, $leaved);

        //驗證是否新增成功
        if ($result->Code == $code) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 編輯staff
     */
    public function editStaff($id, $code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $contact, $residence, $note, $isActive, $arrived, $leaved)
    {
        if ($isActive == '是') {
            $isActive = '1';
        }
        else {
            $isActive = '0';
        }

        $result = $this->ItemRepository->editStaff($id, $code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $contact, $residence, $note, $isActive, $arrived, $leaved);

        //驗證是否編輯成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 刪除staff
     */
    public function deleteStaff($id)
    {
        $result = $this->ItemRepository->deleteStaff($id);

        //驗證是否刪除成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 取得StaffAccessLevel
     */
    public function getStaffAccessLevel()
    {
        $result = $this->ItemRepository->getStaffAccessLevel();

        return $result;
    }
}