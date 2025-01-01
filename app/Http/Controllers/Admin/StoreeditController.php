<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemsStore;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreEditController extends Controller
{
    public function index()
    {
        $items = ItemsStore::all();
        return view('pages.admin.storeedit', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/store'), $imageName);
            $validated['image_path'] = 'images/store/' . $imageName;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);
        
        // Set is_active default
        $validated['is_active'] = $request->has('is_active');

        ItemsStore::create($validated);

        return redirect()->route('admin.store')
            ->with('success', 'Item added successfully');
    }

    public function destroy($id)
    {
        $item = ItemsStore::findOrFail($id);
        
        // Delete image if exists
        if ($item->image_path && file_exists(public_path($item->image_path))) {
            unlink(public_path($item->image_path));
        }
        
        $item->delete();

        return redirect()->route('admin.store')
            ->with('success', 'Item deleted successfully');
    }
}
