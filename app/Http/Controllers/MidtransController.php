<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MidtransPayment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

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
}