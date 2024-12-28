<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function show() {
        return view('pages.order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kg' => 'required|numeric|min:1',
            'order_date' => 'required|date',
            'pickup_date' => 'nullable|date|after_or_equal:order_date',
        ]);

        $price_per_kg = 5000;

        $total_price = $request->kg * $price_per_kg;


        Order::create([
            'user_id' => Auth::id(),
            'order_date' => $request->order_date,
            'pickup_date' => $request->pickup_date,
            'total_price' => $total_price,
            'kg' => $request->kg,
        ]);

        return redirect()->route('orders.create')->with('success', 'Pesanan berhasil dibuat!');
    }
}
