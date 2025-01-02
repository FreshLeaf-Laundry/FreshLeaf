<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('item')
                        ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('store')
                           ->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->item->price;
        });

        return view('pages.checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        try {
            $validated = $request->validate([
                'payment_method' => 'required|in:transfer,cod',
                'voucher' => 'nullable|string',
                'print_invoice' => 'nullable|string'
            ]);

            // ambil barang dari cart
            $cartItems = Cart::where('user_id', Auth::id())
                            ->with('item')
                            ->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Keranjang belanja Anda kosong.');
            }

            $total = $cartItems->sum(function($item) {
                return $item->quantity * $item->item->price;
            });

            // Voucher logic
            $discount = 0;
            if ($request->voucher) {
                $voucher = Voucher::where('code', $request->voucher)
                                ->where('expiry_date', '>', now())
                                ->first();

                if ($voucher) {
                    $discount = $total * ($voucher->discount / 100);
                    $total = $total - $discount;
                }
            }

            // update stock
            foreach($cartItems as $cartItem) {
                $item = $cartItem->item;
                if ($item->stock < $cartItem->quantity) {
                    return back()->with('error', "Stok {$item->name} tidak mencukupi.");
                }
                $item->stock -= $cartItem->quantity;
                $item->save();
            }

            // bersihin cart
            Cart::where('user_id', Auth::id())->delete();

            $message = 'Pesanan berhasil! ';
            if ($discount > 0) {
                $message .= 'Anda mendapatkan diskon sebesar Rp ' . number_format($discount, 0, ',', '.');
            }
            $message .= ' Terima kasih telah berbelanja.';

            // cetak invoice kalau dicentang
            if ($request->has('print_invoice')) {
                return view('pages.invoice', [
                    'cartItems' => $cartItems,
                    'total' => $total,
                    'discount' => $discount
                ]);
            }

            // kalau gak dicentang
            return redirect()->route('home')->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
