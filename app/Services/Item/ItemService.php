<?php

namespace App\Services\Item;

use Carbon\Carbon;

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
        unset($staff['Id']);
        $staff['UpdatedTime'] = Carbon::now()->toDateString();

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
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Code',
                'default' => '',
                'label' => '代號',
                'field' => true,
                'sortable' => true
            ],
            [
                'key' => 'Name',
                'default' => '',
                'label' => '姓名',
                'field' => true,
                'sortable' => true
            ],
            [
                'key' => 'RealName',
                'default' => '',
                'label' => '小姐本名',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'NickName',
                'default' => '',
                'label' => '簡稱',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'SerialNumber',
                'default' => '',
                'label' => '身分證',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'AccessLevel',
                'default' => '董',
                'label' => '職務',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'Phone',
                'default' => '',
                'label' => '電話',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Birthday',
                'default' => '',
                'label' => '生日',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'ContactAddress',
                'default' => '',
                'label' => '聯絡地址',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'ResidenceAddress',
                'default' => '',
                'label' => '戶籍地址',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Note',
                'default' => '',
                'label' => '備註',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'IsDisable',
                'default' => '否',
                'label' => '下檔',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'ArrivedDate',
                'default' => '',
                'label' => '到職日期',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'LeavedDate',
                'default' => '',
                'label' => '離職日期',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Manager',
                'default' => '',
                'label' => '經紀人',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'FileType',
                'default' => 'A',
                'label' => '檔別',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'UpdatedTime',
                'default' => '',
                'label' => '更動日',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'StaffSalaryType',
                'default' => '',
                'label' => '幹部薪別',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'LadySalaryType',
                'default' => '',
                'label' => '小姐薪別',
                'field' => false,
                'sortable' => true
            ],
            [
                'key' => 'ShowColumn',
                'default' => '',
                'label' => 'Show',
                'field' => false,
                'sortable' => true
            ],
            [
                'key' => 'CardNumber',
                'default' => '',
                'label' => '卡號',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'SalaryPerDay',
                'default' => '',
                'label' => '每日保薪',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Liability',
                'default' => '',
                'label' => '責任額',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'BarFeeType',
                'default' => '',
                'label' => '檯費類別',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'BrokerageFeePerDay',
                'default' => '',
                'label' => '經紀費 元/日',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'BrokerageFeePerSection',
                'default' => '',
                'label' => '經紀費 元/節',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'CleaningFee',
                'default' => '',
                'label' => '清潔費',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'SectionPerDay',
                'default' => '',
                'label' => '日回節數',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'SectionCost1',
                'default' => '',
                'label' => '節抽薪1',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'SectionCost2',
                'default' => '',
                'label' => '節抽薪2',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'TakeBarFee',
                'default' => '',
                'label' => '帶檯費',
                'field' => false,
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
        $customers = $this->ItemRepository->getCustomer($sortBy, $sortDirection, $currentPage, $perPage, $filter);
        if ($filter == '') {
            $customersCount = $this->ItemRepository->getCustomerCount();
        }
        else {
            $customersCount = $customers->count();
        }

        $result = $customers->transform(function($item, $key) {
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
            'totalRows' => 0,
            'filter' => $filter
        ]);

        return $collection;
    }

    /**
     * 新增customer
     */
    public function addCustomer($customer)
    {
        unset($customer['Id']);
        $customer['PreUpdatedTime'] = Carbon::now()->toDateString();
        $customer['UpdatedTime'] = Carbon::now()->toDateString();

        $result = $this->ItemRepository->addCustomer($customer);

        //驗證是否新增成功
        if ($result->Code == $customer['Code']) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 新增customer
     */
    public function editCustomer($customer)
    {
        $result = $this->ItemRepository->editCustomer($customer);

        //驗證是否編輯成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 新增customer
     */
    public function deleteCustomer($id)
    {
        $result = $this->ItemRepository->deleteCustomer($id);

        //驗證是否刪除成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 取得customer其他資料
     */
    public function getCustomerMisc()
    {
        //for前端
        $defaultCustomer = [
            [
                'key' => 'Id',
                'default' => '',
                'label' => '編號',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Code',
                'default' => '',
                'label' => '代號',
                'field' => true,
                'sortable' => true
            ],
            [
                'key' => 'Name',
                'default' => '',
                'label' => '姓名',
                'field' => true,
                'sortable' => true
            ],
            [
                'key' => 'Birthday',
                'default' => '',
                'label' => '生日',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Credit',
                'default' => '',
                'label' => '信用額度',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Company',
                'default' => '',
                'label' => '公司',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'IsOpenReceipt',
                'default' => '是',
                'label' => '是否開發票',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'ReceiptTitle',
                'default' => '',
                'label' => '發票檯頭',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'ReceiptAddress',
                'default' => '',
                'label' => '發票地址',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'GetPaidAddress',
                'default' => '',
                'label' => '收款地址',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Contactor',
                'default' => '',
                'label' => '聯絡人',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'TaxNumber',
                'default' => '',
                'label' => '統一編號',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Phone',
                'default' => '',
                'label' => '電話',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Note',
                'default' => '',
                'label' => '備註',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'ReleaseOrderDate',
                'default' => '',
                'label' => '放單日',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'GetPaidDate',
                'default' => '',
                'label' => '收款日',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'ClearLog',
                'default' => '',
                'label' => '清帳方式',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'PreUpdatedTime',
                'default' => '',
                'label' => '前次更動日',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'UpdatedTime',
                'default' => '',
                'label' => '更動日',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'LatestConsumpDate',
                'default' => '',
                'label' => '最後消費日期',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'StaffCode',
                'default' => '',
                'label' => '業績幹部',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'CustomerType',
                'default' => '',
                'label' => '客戶類別',
                'field' => false,
                'sortable' => false
            ]
        ];

        $collection = collect([
            'defaultItem' => $defaultCustomer
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

    /**
     * get staff by code
     */
    public function getStaffByCode($code)
    {
        $staff = $this->ItemRepository->getStaffByCode($code);

        if ($staff == null) {
            $result = '查無此員工';
        }
        else {
            $result = $staff->Name;
        }

        return $result;
    }
}