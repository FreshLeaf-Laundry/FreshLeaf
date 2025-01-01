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

            // cek apakah stok cukup
            $item = ItemsStore::findOrFail($validated['item_id']);
            if ($item->stock < $validated['quantity']) {
                return back()->with('error', 'Stok barang tidak tersedia.');
            }

            // cek klo udh di keranjang
            $existingItem = Cart::where('user_id', Auth::id())
                              ->where('item_id', $validated['item_id'])
                              ->first();

            if ($existingItem) {
                // cek klo stok cukup
                if ($item->stock < ($existingItem->quantity + $validated['quantity'])) {
                    return back()->with('error', 'Stok barang tidak mencukupi.');
                }

                // update quantity
                $existingItem->quantity += $validated['quantity'];
                $existingItem->save();

                // update stok
                $item->stock -= $validated['quantity'];
                $item->save();
            } else {
                // tambah barang baru
                Cart::create([
                    'user_id' => Auth::id(),
                    'item_id' => $validated['item_id'],
                    'quantity' => $validated['quantity']
                ]);

                // update stok
                $item->stock -= $validated['quantity'];
                $item->save();
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
        
            // update stok
            $item = ItemsStore::findOrFail($cartItem->item_id);
            $item->stock += $cartItem->quantity;
            $item->save();
            
            $cartItem->delete();
            
            return back()->with('success', 'Barang berhasil dihapus dari keranjang belanja!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus barang dari keranjang belanja: ' . $e->getMessage());
        }
    }
}