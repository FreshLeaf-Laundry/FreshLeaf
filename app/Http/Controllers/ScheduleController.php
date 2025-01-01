<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = Schedule::orderBy('delivery_date')
                            ->get();
        return view('pages.schedule', compact('schedule'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'delivery_date' => 'required|date|after_or_equal:today',
            'status' => 'string'
        ]);

        Schedule::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dibuat'
        ]);
    }
}