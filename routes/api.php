<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/orders/generate-invoice', [OrderController::class, 'generateInvoice']);
