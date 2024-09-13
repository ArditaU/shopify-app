<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderService;

class OrderController extends Controller
{
    public $orderService;

    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function generateInvoice() {

       return $this->orderService->generateInvoice();
    }

}

