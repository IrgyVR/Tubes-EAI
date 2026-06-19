<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


// 1. Route for Kits (Forwards to Port 8000)
Route::any('/kits/{path?}', function (Request $request, $path = null) {
    // Build the URL carefully to avoid trailing slashes
    $url = "http://kit-service:8000/api/kits" . ($path ? '/' . $path : '');

    // Forward the request AND force it to expect JSON
    $response = Http::acceptJson()->send($request->method(), $url, [
        'json' => $request->all()
    ]);

    return response($response->body(), $response->status())
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', '*')
        ->header('Access-Control-Allow-Headers', '*');;
})->where('path', '.*');


// 2. Route for Orders (Forwards to Port 8001)
Route::any('/orders/{path?}', function (Request $request, $path = null) {
    // Build the URL carefully to avoid trailing slashes
    $url = "http://order-service:8001/api/orders" . ($path ? '/' . $path : '');

    // Forward the request AND force it to expect JSON
    $response = Http::acceptJson()->send($request->method(), $url, [
        'json' => $request->all()
    ]);

    return response($response->body(), $response->status())
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', '*')
        ->header('Access-Control-Allow-Headers', '*');
})->where('path', '.*');

Route::post('/checkout', function (Request $request) {
    $kitResponse = Http::acceptJson()->post('http://kit-service:8000/api/checkout', $request->all());

    $financeResponse = Http::post('http://finance-service:8003', $request->all());

    $xmlData = simplexml_load_string($financeResponse->body());
    $financeMessage = (string) $xmlData->Message;

    return response()->json([
        'inventory_status' => 'Stock updated',
        'finance_status' => $financeMessage
    ])
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', '*')
    ->header('Access-Control-Allow-Headers', '*');
});
