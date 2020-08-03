<?php

namespace App\Services\System;

use Carbon\Carbon;

use App\Repositories\System\SystemRepository;

class SystemService
{
    public function __construct(SystemRepository $systemRepository)
    {
        $this->SystemRepository = $systemRepository;
    }

    public function getSystemParameters()
    {
        $systemParameters = $this->SystemRepository->getSystemParameters();

        $result = $systemParameters->transform(function($item, $key) {
            return $item;
        });

        return [
            'item' => $result->first()
        ];
    }

    public function editSystemParameters($item)
    {
        $item['UpdatedTime'] = Carbon::now()->toDateString();
        
        $result = $this->SystemRepository->editSystemParameters($item);

        //驗證是否編輯成功
        if ($result == true) {
            return true;
        }
        else {
            return false;
        }
    }
}