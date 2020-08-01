<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Exports\StaffExport;
use App\Exports\CustomerExport;
use App\Exports\RoomExport;
use App\Exports\FoodExport;

use App\Services\Item\ItemService;

use App\Http\Requests\Item\ItemRequest;

use App\Http\Resources\Item\ItemResource;

class ItemController extends Controller
{
    protected $ItemService;

    //排序
    private $sortBy = 'Name';
    //排序方法
    private $sortDesc = false;
    //單筆頁數
    private $perPage = 20;
    //目前頁數
    private $currentPage = 1;
    //關鍵字
    private $filter = '';

    public function __construct(ItemService $itemService)
    {
        $this->ItemService = $itemService;
    }

    /**
     * get staff
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getStaff(ItemRequest $request)
    {
        if ($request->has('SortBy') && $request->SortBy != '') {
            $sortBy = $request->SortBy;
        }
        else {
            $sortBy = $this->sortBy;
        }
        if ($request->has('SortDesc') && $request->SortDesc != '') {
            $sortDesc = $request->SortDesc;
        }
        else {
            $sortDesc = $this->sortDesc;
        }
        if ($request->has('CurrentPage') && $request->CurrentPage != '') {
            $currentPage = $request->CurrentPage;
        }
        else {
            $currentPage = $this->currentPage;
        }
        if ($request->has('Filter') && $request->Filter != '') {
            $filter = $request->Filter;
        }
        else {
            $filter = $this->filter;
        }

        if ($sortDesc == 'true') {
            $sortDirection = 'desc';
        }
        else {
            $sortDirection = 'asc';
        }

        $result = $this->ItemService->getStaff($sortBy, $sortDirection, $currentPage, $this->perPage, $filter);
        
        return new ItemResource($result);
    }

    /**
     * add staff
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function addStaff(ItemRequest $request)
    {
        $result = $this->ItemService->addStaff($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * edit staff
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function editStaff(ItemRequest $request)
    {
        $result = $this->ItemService->editStaff($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * delete staff
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function deleteStaff(ItemRequest $request)
    {
        $result = $this->ItemService->deleteStaff(
            $request->Id
        );
        
        return new ItemResource($result);
    }

    /**
     * get staff misc
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function getStaffMisc(ItemRequest $request)
    {
        $result = $this->ItemService->getStaffMisc();
        
        return new ItemResource($result);
    }

    /**
     * get customer misc
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function getCustomerMisc(ItemRequest $request)
    {
        $result = $this->ItemService->getCustomerMisc();
        
        return new ItemResource($result);
    }

    /**
     * get room misc
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function getRoomMisc(ItemRequest $request)
    {
        $result = $this->ItemService->getRoomMisc();

        return new ItemResource($result);
    }

    /**
     * get food misc
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function getFoodMisc(ItemRequest $request)
    {
        $result = $this->ItemService->getFoodMisc();

        return new ItemResource($result);
    }

    /**
     * get item
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getCustomer(ItemRequest $request)
    {
        if ($request->has('SortBy') && $request->SortBy != '') {
            $sortBy = $request->SortBy;
        }
        else {
            $sortBy = $this->sortBy;
        }
        if ($request->has('SortDesc') && $request->SortDesc != '') {
            $sortDesc = $request->SortDesc;
        }
        else {
            $sortDesc = $this->sortDesc;
        }
        if ($request->has('CurrentPage') && $request->CurrentPage != '') {
            $currentPage = $request->CurrentPage;
        }
        else {
            $currentPage = $this->currentPage;
        }
        if ($request->has('Filter') && $request->Filter != '') {
            $filter = $request->Filter;
        }
        else {
            $filter = $this->filter;
        }

        if ($sortDesc == 'true') {
            $sortDirection = 'desc';
        }
        else {
            $sortDirection = 'asc';
        }

        $result = $this->ItemService->getCustomer($sortBy, $sortDirection, $currentPage, $this->perPage, $filter);
        
        return new ItemResource($result);
    }

    /**
     * add customer
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function addCustomer(ItemRequest $request)
    {
        $result = $this->ItemService->addCustomer($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * edit customer
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function editCustomer(ItemRequest $request)
    {
        $result = $this->ItemService->editCustomer($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * delete customer
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function deleteCustomer(ItemRequest $request)
    {
        $result = $this->ItemService->deleteCustomer(
            $request->Id
        );
        
        return new ItemResource($result);
    }

    /**
     * get item
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getRoom(ItemRequest $request)
    {
        if ($request->has('SortBy') && $request->SortBy != '') {
            $sortBy = $request->SortBy;
        }
        else {
            $sortBy = $this->sortBy;
        }
        if ($request->has('SortDesc') && $request->SortDesc != '') {
            $sortDesc = $request->SortDesc;
        }
        else {
            $sortDesc = $this->sortDesc;
        }
        if ($request->has('CurrentPage') && $request->CurrentPage != '') {
            $currentPage = $request->CurrentPage;
        }
        else {
            $currentPage = $this->currentPage;
        }
        if ($request->has('Filter') && $request->Filter != '') {
            $filter = $request->Filter;
        }
        else {
            $filter = $this->filter;
        }

        if ($sortDesc == 'true') {
            $sortDirection = 'desc';
        }
        else {
            $sortDirection = 'asc';
        }

        $result = $this->ItemService->getRoom($sortBy, $sortDirection, $currentPage, $this->perPage, $filter);
        
        return new ItemResource($result);
    }

    /**
     * add room
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function addRoom(ItemRequest $request)
    {
        $result = $this->ItemService->addRoom($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * edit room
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function editRoom(ItemRequest $request)
    {
        $result = $this->ItemService->editRoom($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * delete room
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function deleteRoom(ItemRequest $request)
    {
        $result = $this->ItemService->deleteRoom(
            $request->Id
        );
        
        return new ItemResource($result);
    }

    /**
     * get item
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getFood(ItemRequest $request)
    {
        if ($request->has('SortBy') && $request->SortBy != '') {
            $sortBy = $request->SortBy;
        }
        else {
            $sortBy = $this->sortBy;
        }
        if ($request->has('SortDesc') && $request->SortDesc != '') {
            $sortDesc = $request->SortDesc;
        }
        else {
            $sortDesc = $this->sortDesc;
        }
        if ($request->has('CurrentPage') && $request->CurrentPage != '') {
            $currentPage = $request->CurrentPage;
        }
        else {
            $currentPage = $this->currentPage;
        }
        if ($request->has('Filter') && $request->Filter != '') {
            $filter = $request->Filter;
        }
        else {
            $filter = $this->filter;
        }

        if ($sortDesc == 'true') {
            $sortDirection = 'desc';
        }
        else {
            $sortDirection = 'asc';
        }

        $result = $this->ItemService->getFood($sortBy, $sortDirection, $currentPage, $this->perPage, $filter);
        
        return new ItemResource($result);
    }

    /**
     * add food
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function addFood(ItemRequest $request)
    {
        $result = $this->ItemService->addFood($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * edit food
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function editFood(ItemRequest $request)
    {
        $result = $this->ItemService->editFood($request->Item);
        
        return new ItemResource($result);
    }

    /**
     * delete food
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function deleteFood(ItemRequest $request)
    {
        $result = $this->ItemService->deleteFood(
            $request->Id
        );
        
        return new ItemResource($result);
    }

    /**
     * export staff
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function exportStaff(ItemRequest $request)
    {
        return Excel::download(new StaffExport($request->Columns), 'staff.xlsx');
    }

    /**
     * export customer
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function exportCustomer(ItemRequest $request)
    {
        return Excel::download(new CustomerExport($request->Columns), 'customer.xlsx');
    }

    /**
     * export room
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function exportRoom(ItemRequest $request)
    {
        return Excel::download(new RoomExport($request->Columns), 'room.xlsx');
    }

    /**
     * export food
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function exportFood(ItemRequest $request)
    {
        return Excel::download(new FoodExport($request->Columns), 'food.xlsx');
    }

    /**
     * get staff by code
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getStaffByCode(ItemRequest $request)
    {
        $result = $this->ItemService->getStaffByCode($request->Code);

        return new ItemResource($result);
    }
}
