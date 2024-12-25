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
        $feedbacks = Feedback::with('user')->orderBy('created_at', 'desc')->get();
        return view('pages.feedback', compact('feedbacks'));
    }
}
