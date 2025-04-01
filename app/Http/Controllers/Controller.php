<?php

namespace App\Http\Controllers;

use App\Services\WriteService;

abstract class Controller
{
    protected $writeService;
    public function __construct(WriteService $writeService) {
        $this->writeService = $writeService;
    }
}
