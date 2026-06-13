<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - TRAYA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #fafafa; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 0 20px; }
        
        /* Navbar */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; background: white; }
        .logo-text { font-size: 24px; font-weight: 700; color: #E86F2C; text-decoration: none; }
        .nav-menu { display: flex; gap: 28px; font-size: 14px; }
        .nav-menu a { text-decoration: none; color: #333; }
        .nav-menu a:hover { color: #E86F2C; }
        hr { border: none; border-top: 1px solid #e5e5e5; }

        /* Content Header */
        .page-header { margin: 32px 0 20px; }
        .page-header h1 { font-size: 24px; font-weight: 600; color: #222; }
        
        /* List Pesanan Sederhana */
        .order-list { display: flex; flex-direction: column; gap: 16px; }
        .order-card-simple { background: white; border-radius: 12px; padding: 20px; border: 1px solid #eef0f2; box-shadow: 0 1px 3px rgba(0,0,0,0.02); display: flex; justify-content: space-between; align-items: center; }
        
        /* Bagian Detail Kiri */
        .order-details-left { display: flex; flex-direction: column; gap: 6px; }
        .invoice-num { font-size: 12px; color: #888; font-family: monospace; }
        .product-name { font-size: 16px; font-weight: 600; color: #111; }
        .product-price { font-size: 14px; color: #E86F2C; font-weight: 700; }
        .order-date { font-size: 12px; color: #999; }

        /* Bagian Detail Kanan */
        .order-details-right { display: flex; flex-direction: column; align-items: flex-end; gap: 12px; }
        
        /* Badges */
        .badge-status { display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-success { background: #e8f5e9; color: #2e7d32; }
        .status-failed { background: #ffebee; color: #c62828; }

        /* Tombol Detail */
        .btn-view-detail { text-decoration: none; background: white; color: #E86F2C; border: 1px solid #E86F2C; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .btn-view-detail:hover { background: #FFF3EC; }

        .empty-state { text-align: center; padding: 60px 20px; background: white; border-radius: 12px; border: 1px solid #eef0f2; color: #999; }
    </style>
</head>
<body>

<div class="container">
    <div class="navbar">
        <a href="{{ route('home') }}" class="logo-text">TRAYA</a>
<div class="nav-menu">
    <a href="{{ route('home') }}">Beranda</a>
    <a href="{{ route('products.index') }}">Shop</a>
    
    @auth
        <a href="{{ route('order.my-orders') }}">Pesanan Saya</a>
        <a href="{{ route('chat.index') }}">Chat</a>
    @else
        <a href="{{ route('login') }}">Pesanan Saya</a>
        <a href="{{ route('login') }}">Chat</a>
    @endauth
    
    <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
    <a href="{{ route('bantuan') }}">Bantuan</a>
</div>
    </div>
</div>

<hr>

<div class="container">
    <div class="page-header">
        <h1>Pesanan Saya</h1>
    </div>

    @if(isset($orders) && $orders->count() > 0)
        <div class="order-list">
            @foreach($orders as $order)
                <div class="order-card-simple">
                    
                    <div class="order-details-left">
                        <span class="invoice-num">INV/{{ $order->created_at->format('Ymd') }}/{{ $order->id }}</span>
                        
                        @if(isset($order->products) && $order->products->count() > 0)
                            <h3 class="product-name">{{ $order->products->first()->nama }}</h3>
                            @if($order->products->count() > 1)
                                <span style="font-size: 12px; color: #666;">+{{ $order->products->count() - 1 }} produk lainnya</span>
                            @endif
                        @elseif(isset($order->product))
                            <h3 class="product-name">{{ $order->product->nama }}</h3>
                        @else
                            <h3 class="product-name">Transaksi Produk TRAYA</h3>
                        @endif
                        
                        <span class="product-price">Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</span>
                        <span class="order-date">Dipesan pada: {{ $order->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="order-details-right">
                        <span class="badge-status status-{{ $order->status ?? 'pending' }}">
                            {{ $order->status ?? 'pending' }}
                        </span>
                        
                        <a href="{{ route('order.checkout', $order->id) }}" class="btn-view-detail">
                            Lihat Detail
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p style="font-size: 15px; margin-bottom: 12px;">Belum ada riwayat pesanan.</p>
            <a href="{{ route('products.index') }}" style="color: #E86F2C; text-decoration: none; font-size: 14px; font-weight: 500;">Mulai Jelajahi Produk →</a>
        </div>
    @endif
</div>

</body>
</html>