<?php

namespace App\Http\Controllers;

use App\Service\ProductService;

class MainController extends Controller
{
    public $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
}
