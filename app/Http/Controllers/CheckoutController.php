<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
                'payment_method' => 'required|in:midtrans,cod',
                'voucher' => 'nullable|string',
                'print_invoice' => 'nullable|string'
            ]);

            // Get cart items first
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

            // If payment method is Midtrans, create payment
            if ($request->payment_method === 'midtrans') {
                try {
                    // Debug total
                    Log::info('Checkout amount:', ['total' => $total]);

                    $midtransController = new MidtransController();
                    $response = $midtransController->create(new Request([
                        'payment_amount' => (int)$total  // Ensure it's an integer
                    ]));

                    $responseData = json_decode($response->getContent());
                    
                    Log::info('Midtrans Response:', ['response' => $responseData]);  // Debug response

                    if (isset($responseData->token)) {
                        return redirect()->away('https://app.sandbox.midtrans.com/snap/v3/redirection/' . $responseData->token);
                    }

                    if (isset($responseData->error)) {
                        return back()->with('error', 'Midtrans Error: ' . $responseData->error);
                    }

                    return back()->with('error', 'Gagal membuat pembayaran Midtrans');
                } catch (\Exception $e) {
                    Log::error('Checkout Error:', [
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return back()->with('error', 'Error: ' . $e->getMessage());
                }
            }

            // Process the order and update stock
            foreach($cartItems as $cartItem) {
                $item = $cartItem->item;
                if ($item->stock < $cartItem->quantity) {
                    return back()->with('error', "Stok {$item->name} tidak mencukupi.");
                }
                $item->stock -= $cartItem->quantity;
                $item->save();
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            $message = 'Pesanan berhasil! ';
            if ($discount > 0) {
                $message .= 'Anda mendapatkan diskon sebesar Rp ' . number_format($discount, 0, ',', '.');
            }
            $message .= ' Terima kasih telah berbelanja.';

            // If print invoice is checked, show invoice
            if ($request->has('print_invoice')) {
                return view('pages.invoice', [
                    'cartItems' => $cartItems,
                    'total' => $total,
                    'discount' => $discount
                ]);
            }

            // If not printing invoice, redirect to home with success message
            return redirect()->route('home')->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
