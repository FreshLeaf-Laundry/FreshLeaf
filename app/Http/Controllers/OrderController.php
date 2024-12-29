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

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('user')->orderBy('order_date', 'desc')->get();

        return view('pages.shipping', compact('orders'));
    }

    public function index_admin()
    {
        $orders = Order::with('user')->orderBy('order_date', 'desc')->get();
        return view('pages.admin.invoice', compact('orders'));
    }

   public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:menunggu,proses,diantar']
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.admin')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
