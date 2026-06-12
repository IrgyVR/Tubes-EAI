<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KitController;
use App\Models\Kit;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('kits', KitController::class);

Route::get('/status', function () {
return response()->json(['service' => 'Kit-Service', 'status' => 'Online']);
});

Route::post('/checkout', function (Request $request) {
    foreach ($request->all() as $item) {
        $kit = Kit::find($item['id']);

        if ($kit && $kit->stock > 0) {
            $kit->decrement('stock');
        }
    }
    return response()->json(['message' => 'Stock successfuly updated!']);
});