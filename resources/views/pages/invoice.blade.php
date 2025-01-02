<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p>Tanggal: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->item->name }}</td>
                <td>Rp {{ number_format($item->item->price, 0, ',', '.') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->item->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
        @if(isset($discount) && $discount > 0)
        <p>Diskon: Rp {{ number_format($discount, 0, ',', '.') }}</p>
        <p><strong>Total Setelah Diskon: Rp {{ number_format($total - $discount, 0, ',', '.') }}</strong></p>
        @endif
    </div>

    <div class="no-print" style="margin-top: 30px; text-align: center;">
        <button onclick="window.print()">Cetak Invoice</button>
        <button onclick="window.location.href='{{ route('home') }}'">Kembali ke Home</button>
    </div>
</body>
</html>
