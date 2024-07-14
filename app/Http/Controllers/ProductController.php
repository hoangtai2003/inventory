<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
           'name' => 'required|max:255',
           'description' => 'required',
           'price' => 'required|numeric'
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }
    public function show(Product $product)
    {
        if ($product) {
            return response()->json($product, 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }

    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::update($validated);

        return response()->json($product, 200);
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json('Deleted', 200);
    }
}
