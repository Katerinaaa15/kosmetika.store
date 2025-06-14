<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            
            $orders = Order::where('status', 1)
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);
        } else {
            
            $orders = Auth::user()
                          ->orders()
                          ->where('status', 1)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
        }

        return view('auth.orders.index', compact('orders'));
    }

    
    public function show(Order $order)
    {
        if (! Auth::user()->isAdmin()) {
            // ja nav admins, pārbauda, vai šis pasūtījums pieder viņam
            if (! Auth::user()->orders->contains($order)) {
                return back()->with('warning', 'Tev nav tiesību skatīt šo pasūtījumu.');
            }
        }

        return view('auth.orders.show', compact('order'));
    }
}
