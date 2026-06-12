<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kit;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

/**
 * @OA\Info(
 * title="Gundam API",
 * version="1.0.0"
 * )
 */

class KitController extends Controller
{

    #[OA\Get(
        path: '/api/kits',
        tags: ['Kits'],
        summary: 'List all kits',
        responses: [
            new OA\Response(response: 200, description: 'OK')
        ]
    )]
    public function index()
    {
        $kits = Kit::all();
        return response()->json($kits, 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'grade' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $kit = Kit::create($validated);
        return response()->json($kit, 201);
    }

    public function show($id)
    {
        $kit = Kit::find($id);
        if (!$kit) {
            return response()->json(['message' => 'Kit not found'], 404);
        }
        return response()->json($kit, 200);
    }

    public function update(Request $request, $id)
    {
        $kit = Kit::find($id);
        if (!$kit) return response()->json(['message' => 'Not found'], 404);

        $kit->update($request->all());
        return response()->json($kit, 200);
    }

    public function destroy($id)
    {
        Kit::destroy($id);
        return response()->json(['message' => 'Kit deleted'], 200);
    }
}
