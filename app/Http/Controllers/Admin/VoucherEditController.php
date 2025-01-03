<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VouchersExport;

class VoucherEditController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('pages.admin.vouchers.index', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date|after:today',
        ]);

        Voucher::create($request->all());
        return redirect()->back()->with('success', 'Voucher berhasil ditambahkan');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->back()->with('success', 'Voucher berhasil dihapus');
    }

    public function export() 
    {
        return Excel::download(new VouchersExport, 'vouchers.xlsx');
    }

    public function edit(Voucher $voucher)
    {
        $vouchers = Voucher::latest()->get();
        return view('pages.admin.vouchers.index', compact('vouchers', 'voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|max:255|unique:vouchers,code,' . $voucher->id,
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date|after:today',
        ]);

        $voucher->update($request->all());
        return redirect()->route('admin.vouchers')->with('success', 'Voucher berhasil diperbarui');
    }
} 