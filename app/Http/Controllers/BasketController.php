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

    public function basketConfirm (Request $request) {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route(route:'index');
        }
        $order = Order::find($orderId);
        $success=$order->saveOrder($request->name, $request->phone);
        if ($success){
            session()->flash('success', 'Jūsu pasūtījums ir pieņemts apstrādei!');
        }else{
            session()->flash('warning', 'Notika kļūda!');
        }
        
        return redirect()->route(route:'index');
    }

    public function basketPlace() {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route(route:'index');
        }
        $order = Order::find($orderId);
        return view('order', compact(var_name:'order'));

    }

    public function basketAdd($productId) 
{
    $orderId = session('orderId');
    
    if (is_null($orderId)) {
        // Izveido jaunu pasūtījumu un saglabā to sesijā
        $order = Order::create();  // <- šeit saglabā objektu, nevis ID
        session(['orderId' => $order->id]);
    } else {
        $order = Order::find($orderId);
    }

    // Pārbaudi vai pasūtījumā jau ir šis produkts
    if ($order->products->contains($productId)) {
        $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
        $pivotRow->count++;
        $pivotRow->update();
    } else {
        // Ja nav, pievieno ar count = 1
        $order->products()->attach($productId, ['count' => 1]);
    }

    if(Auth::check()){
        $order->user_id=Auth::id();
        $order->save();
    }
    
    $product=Product::find($productId);
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
