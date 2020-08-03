<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\Resource;

class SystemResource extends Resource
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
            "data" => $this->resource
        ];
    }
}
