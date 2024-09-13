<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OrderInvoiceMail;
use App\Services\OrderService;
use GuzzleHttp\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

