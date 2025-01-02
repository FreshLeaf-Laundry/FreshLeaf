<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim.');
    }

    public function index()
    {
         $userId =  Auth::id();

        $feedbacks2 = Feedback::with('user')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        $feedbacks = Feedback::with('user')->orderBy('created_at', 'desc')->get();
        return view('pages.feedback', compact('feedbacks', 'feedbacks2'));
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);

        return view('pages.admin.edit_feedback', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $feedback->update([
            'message' => $request->message,
        ]);

        return redirect()->route('feedback')->with('success', 'Feedback berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        $feedback->delete();

        return redirect()->route('feedback')->with('success', 'Feedback berhasil dihapus.');
    }
}
