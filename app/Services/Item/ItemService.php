<?php

namespace App\Services\Item;

use Carbon\Carbon;

use App\Repositories\Item\ItemRepository;

class ItemService
{
    protected $ItemRepository;

    private $perPage = 20;

    private $accessLevels = ['董', '常董', '小姐', '櫃檯', '會計', '控檯']; //staff
    private $fileTypes = ['A', 'B', 'C']; //staff

    private $roomLevels = ['一般', '一級', '二級', '三級', '四級', '五級', '六級']; //room

    private $foodTypes = ['酒', '吧', '廚']; // food


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
            'totalRows' => $customersCount,
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
        $rooms = $this->ItemRepository->getRoom($sortBy, $sortDirection, $currentPage, $perPage, $filter);
        if ($filter == '') {
            $roomsCount = $this->ItemRepository->getRoomCount();
        }
        else {
            $roomsCount = $rooms->count();
        }

        $result = $rooms->transform(function($item, $key) {
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
            'totalRows' => $roomsCount,
            'filter' => $filter
        ]);

        return $collection;
    }

    /**
     * 新增room
     */
    public function addRoom($room)
    {
        unset($room['Id']);
        $room['UpdatedTime'] = Carbon::now()->toDateString();

        $result = $this->ItemRepository->addRoom($room);

        //驗證是否新增成功
        if ($result->Code == $room['Code']) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 新增room
     */
    public function editRoom($room)
    {
        $result = $this->ItemRepository->editRoom($room);

        //驗證是否編輯成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 新增room
     */
    public function deleteRoom($id)
    {
        $result = $this->ItemRepository->deleteRoom($id);

        //驗證是否刪除成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 取得room其他資料
     */
    public function getRoomMisc()
    {
        //for前端
        $defaultRoom = [
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
                'key' => 'LimitCount',
                'default' => '',
                'label' => '容納人數',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'MorningPrice',
                'default' => '',
                'label' => '早班價',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'NightPrice',
                'default' =>'',
                'label' => '晚班價',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'TimeoutPrice',
                'default' => '',
                'label' => '逾時價',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'Level',
                'default' => '一般',
                'label' => '級數',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'HaveDefaultOpeningFood',
                'default' => '是',
                'label' => '開桌菜',
                'field' => true,
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
                'key' => 'UpdatedTime',
                'default' => '',
                'label' => '更動日期',
                'field' => true,
                'sortable' => false
            ]
        ];

        $collection = collect([
            'roomLevels' => $this->roomLevels,
            'defaultItem' => $defaultRoom
        ]);

        return $collection;
    }

    /**
     * 取得food後整理資料
     */
    public function getFood($sortBy, $sortDirection, $currentPage, $perPage, $filter)
    {
        $foods = $this->ItemRepository->getFood($sortBy, $sortDirection, $currentPage, $perPage, $filter);
        if ($filter == '') {
            $foodsCount = $this->ItemRepository->getFoodCount();
        }
        else {
            $foodsCount = $foods->count();
        }

        $result = $foods->transform(function($item, $key) {
            $item = $this->splitDefaultOpeningFoodCountPerRoomType($item);
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
            'totalRows' => $foodsCount,
            'filter' => $filter
        ]);

        return $collection;
    }

    /**
     * 新增food
     */
    public function addFood($food)
    {
        $food = $this->mergeDefaultOpeningFoodCountPerRoomType($food);

        unset($food['Id']);
        $food['UpdatedTime'] = Carbon::now()->toDateString();

        $result = $this->ItemRepository->addFood($food);

        //驗證是否新增成功
        if ($result->Code == $food['Code']) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 新增food
     */
    public function editFood($food)
    {
        $food = $this->mergeDefaultOpeningFoodCountPerRoomType($food);
        
        $result = $this->ItemRepository->editFood($food);

        //驗證是否編輯成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 新增food
     */
    public function deleteFood($id)
    {
        $result = $this->ItemRepository->deleteFood($id);

        //驗證是否刪除成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 取得food其他資料
     */
    public function getFoodMisc()
    {
        //for前端
        $defaultFood = [
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
                'label' => '品名',
                'field' => true,
                'sortable' => true
            ],
            [
                'key' => 'Count',
                'default' => '',
                'label' => '單位',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'Type',
                'default' => '酒',
                'label' => '類別',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'IsDefaultOpeningFood',
                'default' =>'是',
                'label' => '開桌菜',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'DefaultOpeningFoodCount1',
                'default' => '',
                'label' => '開桌數(一般)',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'DefaultOpeningFoodCount2',
                'default' => '',
                'label' => '開桌數(一級)',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'DefaultOpeningFoodCount3',
                'default' => '',
                'label' => '開桌數(二級)',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'DefaultOpeningFoodCount4',
                'default' => '',
                'label' => '開桌數(三級)',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'DefaultOpeningFoodCount5',
                'default' => '',
                'label' => '開桌數(四級)',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'DefaultOpeningFoodCount6',
                'default' => '',
                'label' => '開桌數(五級)',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'DefaultOpeningFoodCount7',
                'default' => '',
                'label' => '開桌數(六級)',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'IsFreeService',
                'default' => '否',
                'label' => '是否做招待',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'WineType',
                'default' => '',
                'label' => '酒別',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'SelfHelpPrice',
                'default' => '',
                'label' => '自助售價',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'Price',
                'default' => '',
                'label' => '售價',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'PremiumPrice',
                'default' => '',
                'label' => '會員價',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'SafeCount',
                'default' => '',
                'label' => '安全存量',
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
                'key' => 'IsCount',
                'default' => '是',
                'label' => '計存量',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'CurrentCount',
                'default' => '',
                'label' => '目前存量',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'LatestPurchaseDate',
                'default' => '',
                'label' => '最近進貨日期',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'PurchasePrice',
                'default' => '',
                'label' => '進貨單價',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'PurchaseCompany',
                'default' => '',
                'label' => '進貨廠商',
                'field' => false,
                'sortable' => false
            ],
            [
                'key' => 'IsScore',
                'default' => '是',
                'label' => '計業績',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'IsLowestThershold',
                'default' => '是',
                'label' => '抵低消',
                'field' => true,
                'sortable' => false
            ],
            [
                'key' => 'IsTurnover',
                'default' => '是',
                'label' => '計營業額',
                'field' => true,
                'sortable' => false
            ]
        ];

        $collection = collect([
            'foodTypes' => $this->foodTypes,
            'defaultItem' => $defaultFood
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

    /**
     * split DefaultOpeningFoodCountPerRoomType
     */
    public function splitDefaultOpeningFoodCountPerRoomType($item)
    {
        //from backend to frontend
        $arr = explode(',', $item->DefaultOpeningFoodCountPerRoomType);

        $item->DefaultOpeningFoodCount1 = $arr[0];
        $item->DefaultOpeningFoodCount2 = $arr[1];
        $item->DefaultOpeningFoodCount3 = $arr[2];
        $item->DefaultOpeningFoodCount4 = $arr[3];
        $item->DefaultOpeningFoodCount5 = $arr[4];
        $item->DefaultOpeningFoodCount6 = $arr[5];
        $item->DefaultOpeningFoodCount7 = $arr[6];

        unset($item->DefaultOpeningFoodCountPerRoomType);

        return $item;
    }

    /**
     * merge DefaultOpeningFoodCountPerRoomType
     */
    public function mergeDefaultOpeningFoodCountPerRoomType($items)
    {
        //from frontend to backend
        $items['DefaultOpeningFoodCountPerRoomType'] = implode(',', array(
            $items['DefaultOpeningFoodCount1'],
            $items['DefaultOpeningFoodCount2'],
            $items['DefaultOpeningFoodCount3'],
            $items['DefaultOpeningFoodCount4'],
            $items['DefaultOpeningFoodCount5'],
            $items['DefaultOpeningFoodCount6'],
            $items['DefaultOpeningFoodCount7'],
        ));

        unset($items['DefaultOpeningFoodCount1']);
        unset($items['DefaultOpeningFoodCount2']);
        unset($items['DefaultOpeningFoodCount3']);
        unset($items['DefaultOpeningFoodCount4']);
        unset($items['DefaultOpeningFoodCount5']);
        unset($items['DefaultOpeningFoodCount6']);
        unset($items['DefaultOpeningFoodCount7']);

        return $items;
    }
}