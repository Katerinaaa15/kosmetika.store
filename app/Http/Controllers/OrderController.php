<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Rāda pasūtījumus:
     * - admins redz VISUS status=1 pasūtījumus,
     * - parastais lietotājs tikai savus status=1 pasūtījumus.
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            // Adminam — visi status=1 pasūtījumi
            $orders = Order::where('status', 1)
                           ->orderBy('created_at', 'desc')
                           ->get();
        } else {
            // Parastajam lietotājam — tikai viņa pasūtījumi ar status=1
            $orders = Auth::user()
                          ->orders()
                          ->where('status', 1)
                          ->orderBy('created_at', 'desc')
                          ->get();
        }

        return view('auth.orders.index', compact('orders'));
    }

    /**
     * Apskata konkrētu pasūtījumu:
     * - adminam atļauts jebkurš,
     * - parastajam tikai savs.
     */
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
