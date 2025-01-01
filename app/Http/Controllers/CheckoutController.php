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
                'voucher' => 'nullable|string'
            ]);

            $total = Cart::where('user_id', Auth::id())
                        ->with('item')
                        ->get()
                        ->sum(function($item) {
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
                } else {
                    return back()->with('error', 'Kode voucher tidak valid atau sudah kadaluarsa.');
                }
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            $message = 'Pesanan berhasil! ';
            if ($discount > 0) {
                $message .= 'Anda mendapatkan diskon sebesar Rp ' . number_format($discount, 0, ',', '.');
            }
            $message .= ' Terima kasih telah berbelanja.';

            return redirect()->route('store')->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
