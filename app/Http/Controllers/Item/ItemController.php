<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Item\ItemService;

use App\Http\Requests\Item\ItemRequest;

use App\Http\Resources\Item\ItemResource;

class ItemController extends Controller
{
    protected $ItemService;

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
        $result = $this->ItemService->getStaff();
        
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
        $result = $this->ItemService->addStaff(
            $request->Code, 
            $request->Name, 
            $request->NickName,
            $request->SerialNumber,
            $request->AccessLevelId,
            $request->Phone,
            $request->Birthday,
            $request->IsActive
        );
        
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
        $result = $this->ItemService->editStaff(
            $request->Id,
            $request->Code, 
            $request->Name, 
            $request->NickName,
            $request->SerialNumber,
            $request->AccessLevelId,
            $request->Phone,
            $request->Birthday,
            $request->IsActive
        );
        
        return new ItemResource($result);
    }

    /**
     * get staff access level
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getStaffAccessLevel(ItemRequest $request)
    {
        $result = $this->ItemService->getStaffAccessLevel();
        
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
        return new ItemResource([]);
    }

    /**
     * get item
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getFood(ItemRequest $request)
    {
        return new ItemResource([]);
    }
}
