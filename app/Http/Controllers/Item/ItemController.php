<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Item\ItemRequest;

use App\Http\Resources\Item\ItemResource;

class ItemController extends Controller
{
    /**
     * get item
     *
     * @param App\Http\Requests\Item\ItemRequest
     * @return App\Http\Resources\Item\ItemResource
     */
    public function getStaff(ItemRequest $request)
    {
        $result = collect([
            [
                'id' => 1,
                'no' => 001,
                'name' => 'Kai',
                'status' => 'Green'
            ],
            [
                'id' => 2,
                'no' => 002,
                'name' => 'Lora',
                'status' => 'Red'
            ]
        ]);
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
