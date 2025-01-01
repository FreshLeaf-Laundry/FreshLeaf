<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ItemsStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('item')
                        ->get();
                        
        return view('pages.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        try {
            $validated = $request->validate([
                'item_id' => 'required|exists:store,id',
                'quantity' => 'required|integer|min:1'
            ]);

            // cek apakah barang ada dan stoknya cukup
            $item = ItemsStore::findOrFail($validated['item_id']);
            if ($item->stock < $validated['quantity']) {
                return back()->with('error', 'Stok barang tidak tersedia.');
            }

            // cek apakah barang sudah ada di keranjang
            $existingItem = Cart::where('user_id', Auth::id())
                              ->where('item_id', $validated['item_id'])
                              ->first();

            if ($existingItem) {
                // ubah quantity jika sudah ada di keranjang
                $existingItem->quantity += $validated['quantity'];
                $existingItem->save();
            } else {
                // tambahkan barang baru ke keranjang
                Cart::create([
                    'user_id' => Auth::id(),
                    'item_id' => $validated['item_id'],
                    'quantity' => $validated['quantity']
                ]);
            }

            return back()->with('success', 'Barang berhasil ditambahkan ke keranjang belanja!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan barang ke keranjang belanja: ' . $e->getMessage());
        }
    }

    public function removeFromCart($id)
    {
        try {
            $cartItem = Cart::where('user_id', Auth::id())
                           ->where('id', $id)
                           ->firstOrFail();
                           
            $cartItem->delete();
            
            return back()->with('success', 'Barang berhasil dihapus dari keranjang belanja!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus barang dari keranjang belanja: ' . $e->getMessage());
        }
    }
}