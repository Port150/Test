<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }


    public function show(Product $product)
    {
        return $product;
    }
    public function store(Request $request)
{
    $productData = new ProductData([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'image' => $request->input('image'),
        'description' => $request->input('description'),
        'in_stock' => $request->input('in_stock', true),
    ]);

    $product = Product::create((array) $productData);

    return response()->json($product, 201);
}

public function update(Request $request, Product $product)
{
    $productData = new ProductData([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'image' => $request->input('image'),
        'description' => $request->input('description'),
        'in_stock' => $request->input('in_stock', true),
    ]);

    $product->update((array) $productData);

    return response()->json($product);
}

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
