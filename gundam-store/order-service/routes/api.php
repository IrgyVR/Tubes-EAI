<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Models\Order;


Route::apiResource('orders', OrderController::class);

Route::post('/orders', function (Request $request) {
    $cart = $request->all();
    $savedOrders = [];

    foreach ($cart as $item) {
        $order = Order::create([
            'customer_name' => 'Guest', 
            'kit_id' => $item['id'],
            'quantity' => 1, 
            'total_price' => $item['price']
        ]);
        
        $savedOrders[] = $order->id;
    }

    return response()->json([
        'message' => 'Line items officially recorded!', 
        'receipt_numbers' => $savedOrders
    ]);
});