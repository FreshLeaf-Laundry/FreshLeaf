<?php

namespace App\Http\Controllers;

use App\Models\ItemsStore;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $items = ItemsStore::where('is_active', true)
                          ->where('stock', '>', 0)
                          ->get();
                          
        return view('pages.store', compact('items'));
    }
}
