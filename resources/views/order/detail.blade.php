<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - TRAYA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #fafafa; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 24px; }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; background: white; }
        .logo-text { font-size: 24px; font-weight: 700; color: #E86F2C; text-decoration: none; }
        hr { border: none; border-top: 1px solid #e5e5e5; }
        .card { background: white; border-radius: 16px; padding: 30px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .status-badge { display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .status-pending { background: #fff3e0; color: #e65100; }
        .status-paid { background: #e8f5e9; color: #2e7d32; }
        .status-waiting_confirmation { background: #fff3e0; color: #e65100; }
        .status-cancelled { background: #ffebee; color: #c62828; }
        .status-processed { background: #e3f2fd; color: #1565c0; }
        .status-shipped { background: #e3f2fd; color: #1565c0; }
        .status-delivered { background: #e8f5e9; color: #2e7d32; }
        .btn-primary { background: #E86F2C; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 13px; border: none; cursor: pointer; }
        .btn-secondary { background: #f5f5f5; color: #666; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>

<div class="container">
    <div class="navbar">
        <a href="{{ route('home') }}" class="logo-text">TRAYA</a>
    </div>
</div>
<hr>

<div class="container">
    <div class="card">
        <h1 style="color: #E86F2C; margin-bottom: 20px;">Detail Pesanan</h1>
        
        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;">
            <div>
                <strong>No. Pesanan:</strong> {{ $order->order_number }}<br>
                <strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
            </div>
            <div>
                <span class="status-badge status-{{ $order->order_status }}">Status: {{ ucfirst($order->order_status) }}</span>
                <span class="status-badge status-{{ $order->payment_status }}">Pembayaran: {{ str_replace('_', ' ', ucfirst($order->payment_status)) }}</span>
            </div>
        </div>
        
        <div style="border-top: 1px solid #eee; padding-top: 20px;">
            <h3>Produk</h3>
            @foreach($order->items as $item)
            <div style="display: flex; gap: 15px; padding: 15px 0; border-bottom: 1px solid #eee;">
                <div style="width: 60px; height: 60px; background: #f5f5f5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    📦
                </div>
                <div style="flex: 1;">
                    <strong>{{ $item->product_name }}</strong><br>
                    Harga: Rp {{ number_format($item->product_price, 0, ',', '.') }}<br>
                    Jumlah: {{ $item->quantity }}
                </div>
                <div style="font-weight: bold;">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </div>
            </div>
            @endforeach
            
            <div style="text-align: right; padding-top: 15px;">
                <strong>Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
            </div>
        </div>
        
        <div style="background: #f8f8f8; padding: 20px; border-radius: 12px; margin-top: 20px;">
            <h3>Informasi Pengiriman</h3>
            <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Telepon:</strong> {{ $order->phone_number }}</p>
            @if($order->notes)<p><strong>Catatan:</strong> {{ $order->notes }}</p>@endif
        </div>
        
        @if(auth()->id() == $order->seller_id && $order->payment_method == 'transfer' && $order->payment_status == 'waiting_confirmation')
            <div style="margin-top: 20px;">
                <form method="POST" action="{{ route('order.confirm-payment', $order->id) }}">
                    @csrf
                    <button type="submit" class="btn-primary">Konfirmasi Pembayaran</button>
                </form>
            </div>
        @endif
        
        @if(auth()->id() == $order->seller_id && $order->order_status != 'completed' && $order->order_status != 'cancelled')
            <div style="margin-top: 20px;">
                <form method="POST" action="{{ route('order.update-status', $order->id) }}">
                    @csrf
                    @method('PUT')
                    <select name="order_status" style="padding: 8px; border-radius: 8px;">
                        <option value="processed" {{  }}