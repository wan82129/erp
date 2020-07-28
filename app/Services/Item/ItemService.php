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
            /*return [
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
                'FileType' => $item['FileType'],
                'UpdatedTime' => $item['UpdatedTime']
            ];*/
            return $item;
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
                'label' => '小姐本名',
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
            [
                'key' => 'UpdatedTime',
                'default' => '',
                'label' => '更動日',
                'sortable' => false
            ],
            [
                'key' => 'StaffSalaryType',
                'default' => '',
                'label' => '幹部薪別',
                'sortable' => false
            ],
            [
                'key' => 'LadySalaryType',
                'default' => '',
                'label' => '小姐薪別',
                'sortable' => true
            ],
            [
                'key' => 'ShowColumn',
                'default' => '',
                'label' => 'Show',
                'sortable' => true
            ],
            [
                'key' => 'CardNumber',
                'default' => '',
                'label' => '卡號',
                'sortable' => false
            ],
            [
                'key' => 'SalaryPerDay',
                'default' => '',
                'label' => '每日保薪',
                'sortable' => false
            ],
            [
                'key' => 'Liability',
                'default' => '',
                'label' => '責任額',
                'sortable' => false
            ],
            [
                'key' => 'BarFeeType',
                'default' => '',
                'label' => '檯費類別',
                'sortable' => false
            ],
            [
                'key' => 'BrokerageFeePerDay',
                'default' => '',
                'label' => '經紀費 元/日',
                'sortable' => false
            ],
            [
                'key' => 'BrokerageFeePerSection',
                'default' => '',
                'label' => '經紀費 元/節',
                'sortable' => false
            ],
            [
                'key' => 'CleaningFee',
                'default' => '',
                'label' => '清潔費',
                'sortable' => false
            ],
            [
                'key' => 'SectionPerDay',
                'default' => '',
                'label' => '日回節數',
                'sortable' => false
            ],
            [
                'key' => 'SectionCost1',
                'default' => '',
                'label' => '節抽薪1',
                'sortable' => false
            ],
            [
                'key' => 'SectionCost2',
                'default' => '',
                'label' => '節抽薪2',
                'sortable' => false
            ],
            [
                'key' => 'TakeBarFee',
                'default' => '',
                'label' => '帶檯費',
                'sortable' => false
            ]
        ];

        $collection = collect([
            'accessLevels' => $this->accessLevels,
            'fileTypes' => $this->fileTypes,
            'defaultItem' => $defaultStaff
        ]);

        return $collection;
    }

    /**
     * 取得customer後整理資料
     */
    public function getCustomer($sortBy, $sortDirection, $currentPage, $perPage, $filter)
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
     * 取得room後整理資料
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
     * 取得food後整理資料
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