<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orderId = session(key:'orderId');
        if (!is_null($orderId)) {
            $order=Order::findOrFail($orderId);
            if ($order->products->count()>0){
                return $next($request);
            }
        }
        
        session()->flash('warning', 'Jūsu grozs ir tukšs!');
                return redirect()->route('index');
    }
}
