<?php

namespace App\Services\Item;

use App\Repositories\Item\ItemRepository;

class ItemService
{
    protected $ItemRepository;

    private $perPage = 20;
    private $accessLevels = ['董', '常董', '小姐', '櫃檯', '會計', '控檯'];
    private $fileTypes = ['A', 'B', 'C'];

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
            if ($item['IsDisable'] == 1) {
                $item['IsDisable'] = '是';
            }
            else {
                $item['IsDisable'] = '否';
            }
            return [
                'Id' => $item['Id'],
                'Code' => $item['Code'],
                'Name' => $item['Name'],
                'RealName' => $item['RealName'],
                'NickName' => $item['NickName'],
                'SerialNumber' => $item['SerialNumber'],
                'AccessLevel' => $item['AccessLevel'],
                'Phone' => $item['Phone'],
                'Birthday' => $item['Birthday'],
                'ContactAddress' => $item['ContactAddress'],
                'ResidenceAddress' => $item['ResidenceAddress'],
                'Note' => $item['Note'],
                'IsDisable' => $item['IsDisable'],
                'ArrivedDate' => $item['ArrivedDate'],
                'LeavedDate' => $item['LeavedDate'],
                'Manager' => $item['Manager'],
                'FileType' => $item['FileType']
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
    public function addStaff($staff)
    {
        if ($staff['IsDisable'] == '是') {
            $staff['IsDisable'] = '1';
        }
        else {
            $staff['IsDisable'] = '0';
        }

        $result = $this->ItemRepository->addStaff($staff);

        //驗證是否新增成功
        if ($result->Code == $staff['Code']) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 編輯staff
     */
    public function editStaff($staff)
    {
        if ($staff['IsDisable'] == '是') {
            $staff['IsDisable'] = '1';
        }
        else {
            $staff['IsDisable'] = '0';
        }

        $result = $this->ItemRepository->editStaff($staff);

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
     * 取得staff其他資料
     */
    public function getStaffMisc()
    {
        //for前端
        $defaultStaff = [
            [
                'key' => 'Id',
                'default' => '',
                'label' => '編號',
                'sortable' => false
            ],
            [
                'key' => 'Code',
                'default' => '',
                'label' => '代號',
                'sortable' => true
            ],
            [
                'key' => 'Name',
                'default' => '',
                'label' => '姓名',
                'sortable' => true
            ],
            [
                'key' => 'RealName',
                'default' => '',
                'label' => '本名',
                'sortable' => false
            ],
            [
                'key' => 'NickName',
                'default' => '',
                'label' => '簡稱',
                'sortable' => false
            ],
            [
                'key' => 'SerialNumber',
                'default' => '',
                'label' => '身分證',
                'sortable' => false
            ],
            [
                'key' => 'AccessLevel',
                'default' => '董',
                'label' => '職務',
                'sortable' => false
            ],
            [
                'key' => 'Phone',
                'default' => '',
                'label' => '電話',
                'sortable' => false
            ],
            [
                'key' => 'Birthday',
                'default' => '',
                'label' => '生日',
                'sortable' => false
            ],
            [
                'key' => 'ContactAddress',
                'default' => '',
                'label' => '聯絡地址',
                'sortable' => false
            ],
            [
                'key' => 'ResidenceAddress',
                'default' => '',
                'label' => '戶籍地址',
                'sortable' => false
            ],
            [
                'key' => 'Note',
                'default' => '',
                'label' => '備註',
                'sortable' => false
            ],
            [
                'key' => 'IsDisable',
                'default' => '否',
                'label' => '下檔',
                'sortable' => false
            ],
            [
                'key' => 'ArrivedDate',
                'default' => '',
                'label' => '到職日期',
                'sortable' => false
            ],
            [
                'key' => 'LeavedDate',
                'default' => '',
                'label' => '離職日期',
                'sortable' => false
            ],
            [
                'key' => 'Manager',
                'default' => '',
                'label' => '經紀人',
                'sortable' => false
            ],
            [
                'key' => 'FileType',
                'default' => 'A',
                'label' => '檔別',
                'sortable' => false
            ],
        ];

        $collection = collect([
            'accessLevels' => $this->accessLevels,
            'fileTypes' => $this->fileTypes,
            'defaultItem' => $defaultStaff
        ]);

        return $collection;
    }

    /**
     * 取得staff後整理資料
     */
    public function getRoom($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        if ($sortDirection == 'desc') {
            $sortDesc = true;
        }
        else {
            $sortDesc = false;
        }

        $collection = collect([
            'items' => collect(),
            'sortBy' => $sortBy,
            'sortDesc' => $sortDesc,
            'currentPage' => $currentPage,
            'perPage' => $this->perPage,
            'totalRows' => 0,
            'filter' => $filter
        ]);

        return $collection;
    }

    /**
     * 取得staff後整理資料
     */
    public function getFood($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        if ($sortDirection == 'desc') {
            $sortDesc = true;
        }
        else {
            $sortDesc = false;
        }

        $collection = collect([
            'items' => collect(),
            'sortBy' => $sortBy,
            'sortDesc' => $sortDesc,
            'currentPage' => $currentPage,
            'perPage' => $this->perPage,
            'totalRows' => 0,
            'filter' => $filter
        ]);

        return $collection;
    }
}