<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // This is the magic tool!

class OrderController extends Controller
{
    public function index()
{
    // Return all orders from the database
    $orders = Order::all();
    return response()->json($orders, 200);
}
    public function store(Request $request)
    {
        // 1. Call the Kit-Service to see if the Gundam exists
        // (Assuming your Kit-Service is running on port 8000)
        $response = Http::get("http://127.0.0.1:8000/api/kits/" . $request->kit_id);

        // 2. Check if the Kit-Service returned a 404 (Not Found)
        if ($response->failed()) {
            return response()->json(['error' => 'Gundam kit not found in inventory!'], 404);
        }

        $kitData = $response->json();

        // 3. Check if there is enough stock
        if ($kitData['stock'] < $request->quantity) {
            return response()->json(['error' => 'Not enough stock available!'], 400);
        }

        // 4. If all is good, calculate price and save the order!
        $totalPrice = $kitData['price'] * $request->quantity;

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'kit_id' => $request->kit_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return response()->json([
            'message' => 'Order placed successfully!',
            'purchased_item' => $kitData['name'],
            'order_details' => $order
        ], 201);
    }
}