<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
class FaqController extends Controller
{
    public function index()
    {
        $faqs = FAQ::orderBy('order')->get();
        return view('pages.admin.faqedit', compact('faqs'));
    }

    public function store(Request $request)
    {
        // Validate 
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        // buat faq
        FAQ::create($validated);

        // success message
        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ created successfully');
    }

    public function reorder(Request $request)
    {
        $items = $request->items;
        
        foreach ($items as $item) {
            FAQ::where('id', $item['id'])->update(['order' => $item['order']]);
        }
        
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        try {
            $faq = FAQ::findOrFail($id);
            $faq->delete();

            return redirect()->route('admin.faq.index')
                ->with('success', 'FAQ deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.faq.index')
                ->with('error', 'Error deleting FAQ');
        }
    }
}
