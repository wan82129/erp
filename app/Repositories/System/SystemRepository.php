<?php

namespace App\Repositories\System;

use Carbon\Carbon;

use App\Models\SystemParametersModel;

class SystemRepository
{
    public function __construct(SystemParametersModel $systemParametersModel)
    {
        $this->SystemParametersModel = $systemParametersModel;
    }

    /**
     * get system parameters
     */
    public function getSystemParameters()
    {
        $result = $this->SystemParametersModel->all();
        
        return $result;
    }

    /**
     * edit system parameters
     */
    public function editSystemParameters($item)
    {
        $result = $this->SystemParametersModel::updateOrCreate(
            ['Id' => 1],
            $item
        );

        return $result;
    }
}
