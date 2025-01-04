<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MidtransPayment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class MidtransController extends Controller
{
    protected $client;
    protected $serverKey;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->client = new Client([
            'base_uri' => 'https://app.sandbox.midtrans.com/snap/v1/',
            'verify' => false
        ]);
    }

    public function create(Request $request)
    {
        try {
            $orderId = 'ORDER-' . time();
            $amount = (int)$request->payment_amount;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $amount
                ],
                'item_details' => [[
                    'id' => '1',
                    'price' => $amount,
                    'quantity' => 1,
                    'name' => 'Layanan Laundry'
                ]],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email
                ],
                'callbacks' => [
                    'finish' => route('home'),
                    'error' => route('home'),
                    'pending' => route('home')
                ]
            ];

            $response = $this->client->post('transactions', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':')
                ],
                'json' => $params
            ]);

            $responseData = json_decode($response->getBody());
            
            $payment = new MidtransPayment;
            $payment->cart_id = $orderId;
            $payment->payment_status = 'pending';
            $payment->payment_amount = $amount;
            $payment->payment_date = now();
            $payment->save();

            \App\Models\Cart::where('user_id', Auth::id())->delete();

            return response()->json(['token' => $responseData->token]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        Log::info('Midtrans callback received', ['request' => $request->all()]);
        // Ambil data notifikasi dari Midtrans
        $notification = json_decode($request->getContent(), true);

        // Temukan pembayaran berdasarkan order_id
        $payment = MidtransPayment::where('cart_id', $notification['order_id'])->first();

        if ($payment) {
            // Update status pembayaran berdasarkan notifikasi
            $payment->payment_status = $notification['transaction_status'];
            $payment->payment_date = now(); // Atur tanggal pembayaran

            // Tambahkan logika untuk menangani berbagai status transaksi
            switch ($notification['transaction_status']) {
                case 'settlement':
                    // Pembayaran berhasil
                    $payment->payment_status = 'settled';
                    break;
                case 'pending':
                    // Pembayaran masih pending
                    $payment->payment_status = 'pending';
                    break;
                case 'failed':
                    // Pembayaran gagal
                    $payment->payment_status = 'failed';
                    break;
                case 'cancel':
                    // Pembayaran dibatalkan
                    $payment->payment_status = 'cancelled';
                    break;
                // Tambahkan status lain jika diperlukan
            }

            // Update informasi tambahan jika diperlukan
            $payment->transaction_id = $notification['transaction_id'] ?? null; // Menyimpan transaction_id
            $payment->gross_amount = $notification['gross_amount'] ?? null; // Menyimpan gross_amount
            $payment->payment_type = $notification['payment_type'] ?? null; // Menyimpan payment_type
            $payment->settlement_time = $notification['settlement_time'] ?? null; // Menyimpan settlement_time
            $payment->currency = $notification['currency'] ?? null; // Menyimpan currency

            $payment->save();

            // Kembalikan response sukses ke Midtrans
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Payment not found'], 404);
    }
}