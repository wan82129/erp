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
     * get item
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
        return new ItemResource('room');
    }

    /**
     * get item
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getFood(ItemRequest $request)
    {
        return new ItemResource('food');
    }
}
