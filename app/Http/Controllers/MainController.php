<?php

namespace App\Http\Controllers;

use app\Http\Controllers\Controller;
use App\Service\ProductService;

class MainController extends Controller
{
    public $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
}
