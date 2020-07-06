<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Resources\Json\Resource;

class ItemResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "status" => "success",
            "code" => "1",
            "data" => $this->resource->transform(function($item, $key) {
                return [
                    'id' => $item['id'],
                    'no' => $item['no'],
                    'name' => $item['name'],
                    'status' => $item['status']
                ];
            })
        ];
    }
}
