<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $products = Product::with('category')->get(); // ar kategoriju datiem
    return view('auth.products.index', compact('products'));
}

public function create()
{
    return view('auth.products.form');
}

public function store(ProductRequest $request)
{
    $data = $request->validated();

    // failu uploads
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products','public');
    }

    // Apstrādā ķeksīšus pievienojot 1/0
    foreach (['hit','new','recommend'] as $field) {
        $data[$field] = $request->has($field) ? 1 : 0;
    }

    Product::create($data);
    return redirect()->route('products.index');
}

public function show(Product $product)
{
    return view('auth.products.show', compact('product'));
}

public function edit(Product $product)
{
    return view('auth.products.form', compact('product'));
}

public function update(ProductRequest $request, Product $product)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($product->image);
        $data['image'] = $request->file('image')->store('products','public');
    }

    foreach (['hit','new','recommend'] as $field) {
        $data[$field] = $request->has($field) ? 1 : 0;
    }

    $product->update($data);
    return redirect()->route('products.index');
}

public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index');
}
}