<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Exports\StaffExport;

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
     * get room misc
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function getRoomMisc(ItemRequest $request)
    {
        return new ItemResource(true);
    }

    /**
     * get food misc
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    
    public function getFoodMisc(ItemRequest $request)
    {
        return new ItemResource(true);
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
     * export staff
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function exportStaff(ItemRequest $request)
    {
        return Excel::download(new StaffExport, 'staff.xlsx');
    }
}
