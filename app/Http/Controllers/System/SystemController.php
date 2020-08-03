<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\System\SystemService;

use App\Http\Requests\System\SystemRequest;

use App\Http\Resources\System\SystemResource;

class SystemController extends Controller
{
    //
    public function __construct(SystemService $systemService)
    {
        $this->SystemService = $systemService;
    }

    /**
     * get system parameters
     * 
     * @param App\Http\Requests\System\SystemRequest
     * @return App\Http\Resources\System\SystemResource
     */
    public function getSystemParameters(SystemRequest $request)
    {
        $result = $this->SystemService->getSystemParameters();

        return new SystemResource($result);
    }

    /**
     * edit system parameters
     * 
     * @param App\Http\Requests\System\SystemRequest
     * @return App\Http\Resources\System\SystemResource
     */
    public function editSystemParameters(SystemRequest $request)
    {
        $result = $this->SystemService->editSystemParameters($request->Item);

        return new SystemResource($result);
    }
}
