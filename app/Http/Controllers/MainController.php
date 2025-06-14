<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class MainController extends Controller
{
    public function index(Request $request)
{
    $validator = Validator::make($request->all(), [
        'price_from' => 'nullable|numeric|min:0',
        'price_to'   => 'nullable|numeric|min:0|gte:price_from',
        'hit'        => 'nullable',
        'new'        => 'nullable',
        'recommend'  => 'nullable',
    ], [
        'price_from.numeric' => 'Laukā "Cena no" jāievada skaitlis.',
        'price_from.min'     => 'Laukā "Cena no" nevar būt negatīvs skaitlis.',
        'price_to.numeric'   => 'Laukā "līdz" jāievada skaitlis.',
        'price_to.min'       => 'Laukā "līdz" nevar būt negatīvs skaitlis.',
        'price_to.gte'       => 'Laukā "līdz" jābūt skaitlim, kas nav mazāks par "Cena no".',
    ]);

    if ($validator->fails()) {
        $products = Product::paginate(6); 
        return view('index', [
            'products' => $products,
        ])->withErrors($validator); 
    }

    
    $productsQuery = Product::query();
    if ($request->filled('price_from')) {
        $productsQuery->where('price', '>=', $request->price_from);
    }
    if ($request->filled('price_to')) {
        $productsQuery->where('price', '<=', $request->price_to);
    }
    if ($request->has('hit')) {
        $productsQuery->where('hit', 1);
    }
    if ($request->has('new')) {
        $productsQuery->where('new', 1);
    }
    if ($request->has('recommend')) {
        $productsQuery->where('recommend', 1);
    }

    $products = $productsQuery->paginate(6)->withQueryString();

    return view('index', compact('products'));
}


    public function categories() {
        $categories = Category::get();
        return view('categories', compact(var_name:'categories'));
    }

    public function category($code) {
        $category = Category::where('code', $code)->firstOrFail();
        return view('category', compact('category'));
    }
    
    
    

    public function product(Category $category, Product $product)
    {
       
        return view('product', compact('category','product'));
    }

    
}
