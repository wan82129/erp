<?php

namespace App\Services\Item;

use App\Repositories\Item\ItemRepository;

class ItemService
{
    protected $ItemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->ItemRepository = $itemRepository;
    }

    /**
     * 取得staff後整理資料
     */
    public function getStaff()
    {
        $staffs = $this->ItemRepository->getStaff();

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
                'IsActive' => $IsActive,
            ];
        });

        return $result;
    }

    /**
     * 新增staff
     */
    public function addStaff($code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $isActive)
    {
        if ($isActive == '是') {
            $isActive = '1';
        }
        else {
            $isActive = '0';
        }

        $result = $this->ItemRepository->addStaff($code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $isActive);

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
    public function editStaff($id, $code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $isActive)
    {
        if ($isActive == '是') {
            $isActive = '1';
        }
        else {
            $isActive = '0';
        }

        $result = $this->ItemRepository->editStaff($id, $code, $name, $nickName, $serialNumber, $accessLevelId, $phone, $birthday, $isActive);

        //驗證是否新增成功
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