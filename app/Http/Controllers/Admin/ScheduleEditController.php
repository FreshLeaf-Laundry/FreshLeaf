<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleEditController extends Controller
{
    public function index()
    {
        $schedule = Schedule::latest()->get();
        return view('pages.admin.schedule.index', compact('schedule'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'delivery_date' => 'required|date|after_or_equal:today',
            'status' => 'required|string|in:diambil,diproses,diantar,selesai'
        ]);

        Schedule::create($request->all());
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|string|in:diambil,diproses,diantar,selesai'
        ]);

        $schedule->update($validated);
        return redirect()->back()->with('success', 'Status jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }
}