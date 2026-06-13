<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - TRAYA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #fafafa; }
        .container { max-width: 600px; margin: 0 auto; padding: 60px 24px; text-align: center; }
        .card { background: white; border-radius: 24px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        .success-icon { font-size: 80px; margin-bottom: 20px; }
        h1 { color: #2e7d32; margin-bottom: 15px; }
        .order-number { background: #f5f5f5; padding: 10px; border-radius: 12px; font-size: 18px; margin: 20px 0; }
        .btn-primary { background: #E86F2C; color: white; padding: 12px 24px; border-radius: 30px; text-decoration: none; display: inline-block; margin: 10px 5px; }
        .btn-secondary { background: #f5f5f5; color: #666; padding: 12px 24px; border-radius: 30px; text-decoration: none; display: inline-block; margin: 10px 5px; }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="success-icon">✅</div>
        <h1>Pesanan Berhasil!</h1>
        <p style="color: #666; margin-bottom: 20px;">Pesanan Anda telah kami terima</p>
        
        <div class="order-number">
            No. Pesanan: <strong>{{ $order->order_number }}</strong>
        </div>
        
        @if($order->payment_method == 'cod')
            <p style="background: #e3f2fd; padding: 15px; border-radius: 12px; margin: 20px 0;">
                💡 Anda akan membayar saat barang diterima (COD)
            </p>
        @else
            <p style="background: #fff3e0; padding: 15px; border-radius: 12px; margin: 20px 0;">
                💡 Silakan upload bukti transfer untuk mengonfirmasi pembayaran
            </p>
            <a href="{{ route('order.upload-proof', $order->id) }}" class="btn-primary">Upload Bukti Transfer</a>
        @endif
        
        <div style="margin-top: 20px;">
            <a href="{{ route('order.detail', $order->id) }}" class="btn-secondary">Lihat Detail Pesanan</a>
            <a href="{{ route('products.index') }}" class="btn-primary">Lanjut Belanja</a>
        </div>
    </div>
</div>
</body>
</html>