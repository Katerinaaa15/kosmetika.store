<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BasketController extends Controller
{
    public function basket() {
        $orderId = session('orderId');
        $order = null;
    
        if ($orderId) {
            $order = Order::find($orderId);
        }
    
        // Nodrošini, ka `$order` ir Order objekts vai null
        return view('basket', compact('order'));
    }

    // BasketController.php

public function basketConfirm(Request $request)
{
    $orderId = session('orderId');
    if (is_null($orderId)) {
        return redirect()->route('index');
    }

    $order = Order::find($orderId);
    $success = $order->saveOrder($request->name, $request->phone);

    if ($success) {
        // Samazini katra produkta daudzumu
        foreach ($order->products as $product) {
            $product->decrement('count', $product->pivot->count);
        }

        session()->flash('success', 'Jūsu pasūtījums ir pieņemts apstrādei!');
    } else {
        session()->flash('warning', 'Notika kļūda!');
    }

    return redirect()->route('index');
}

    public function basketPlace() {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route(route:'index');
        }
        $order = Order::find($orderId);
        return view('order', compact(var_name:'order'));

    }

    public function basketAdd(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $availableCount = $request->input('available_count', 0);
        $orderId = session('orderId');
    
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }
    
        // Pārbauda, vai pieprasītais daudzums nepārsniedz pieejamo daudzumu
        $requestedCount = $order->products()->where('product_id', $productId)->sum('order_product.count') + 1;
        if ($requestedCount > $availableCount) {
            return redirect()->route('product', $product)->withErrors([
                'quantity' => 'Nav pietiekami daudz preces noliktavā.'
            ]);
        }
    
        // Ja viss ir kārtībā, pievieno preci grozam
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId, ['count' => 1]);
        }
    
        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }
    
        session()->flash('success', 'Pievienots produkts: ' . $product->name);
        return redirect()->route('basket');
    }
    
    
    public function basketRemove ($productId)
    {
        $orderId = session(key:'orderId');
        if (is_null($orderId)) {
            return redirect()->route(route:'basket');
        }
        $order = Order::find($orderId);

        if($order->products->contains($productId)) {
            $pivotRow= $order->products()->where('product_id', $productId)->first()->pivot;
            if($pivotRow->count < 2) {
                $order->products()->detach($productId);

            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
            
        }
        $product=Product::find($productId);
        session()->flash('warning', 'Noņemts produkts: ' . $product->name);
        
        return redirect()->route(route:'basket');
    }
}
