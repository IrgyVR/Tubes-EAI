<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

// This opens the door for your orders!
Route::apiResource('orders', OrderController::class);