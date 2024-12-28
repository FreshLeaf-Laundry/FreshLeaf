<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::where('expiry_date', '>', now())
                          ->orderBy('expiry_date')
                          ->get();
        return view('pages.voucher', compact('vouchers'));
    }

    public function redeem(Request $request)
    {
        $voucher = Voucher::where('code', $request->code)
                         ->where('expiry_date', '>', now())
                         ->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher tidak valid atau sudah kadaluarsa'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Voucher berhasil digunakan',
            'discount' => $voucher->discount
        ]);
    }

    public function check($code)
    {
        $voucher = Voucher::where('code', $code)
                         ->where('expiry_date', '>', now())
                         ->first();

        return response()->json([
            'valid' => $voucher ? true : false,
            'discount' => $voucher ? $voucher->discount : 0
        ]);
    }
}