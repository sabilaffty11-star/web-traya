<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - TRAYA</title>
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

        /* Detail Container */
        .back-link { display: inline-block; margin-top: 24px; color: #666; text-decoration: none; font-size: 14px; }
        .back-link:hover { color: #E86F2C; }
        
        .main-title { margin: 16px 0 24px; font-size: 22px; font-weight: 600; }
        
        .card-simple { background: white; border-radius: 12px; padding: 24px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); border: 1px solid #eef0f2; }
        .card-title { font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #111; border-bottom: 1px solid #f5f5f5; padding-bottom: 8px; }
        
        /* Grid Informasi */
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; font-size: 14px; }
        .info-label { color: #666; font-size: 13px; margin-bottom: 4px; }
        .info-value { font-weight: 500; color: #222; }
        
        /* Status Badges */
        .badge { display: inline-block; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 500; text-transform: uppercase; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-success { background: #e8f5e9; color: #2e7d32; }
        .badge-failed { background: #ffebee; color: #c62828; }

        /* Item Produk */
        .product-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #fafafa; }
        .product-item:last-child { border-bottom: none; }
        .prod-name { font-weight: 500; font-size: 14px; }
        .prod-price { color: #E86F2C; font-weight: 600; font-size: 14px; }
        
        .total-row { display: flex; justify-content: space-between; margin-top: 12px; padding-top: 12px; border-top: 1px dashed #e5e5e5; font-size: 16px; font-weight: 700; }

        /* Form Upload Ringan */
        .form-group { margin-top: 8px; }
        .file-input { display: block; width: 100%; padding: 10px; font-size: 14px; border: 1px dashed #ccc; border-radius: 8px; background: #fdfdfd; cursor: pointer; margin-bottom: 12px; }
        .btn-submit { background: #E86F2C; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; width: 100%; transition: background 0.2s; }
        .btn-submit:hover { background: #d45a1a; }
        
        .proof-img-preview { width: 100%; max-height: 250px; object-fit: contain; background: #f5f5f5; border-radius: 8px; margin-top: 10px; border: 1px solid #e5e5e5; }
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
    <a href="{{ route('order.my-orders') }}" class="back-link">← Kembali ke Pesanan Saya</a>
    
    <h1 class="main-title">Detail Pesanan #{{ $order->id }}</h1>

    <div class="card-simple">
        <div class="info-grid">
            <div>
                <div class="info-label">Waktu Transaksi</div>
                <div class="info-value">{{ $order->created_at->format('d M Y, H:i') }} WIB</div>
            </div>
            <div>
                <div class="info-label">Status Pembayaran</div>
                <div>
                    <span class="badge badge-{{ $order->status ?? 'pending' }}">
                        {{ $order->status ?? 'Pending' }}
                    </span>
                </div>
            </div>
            <div>
                <div class="info-label">Metode Pembayaran</div>
                <div class="info-value">{{ strtoupper($order->payment_method ?? 'Transfer Bank') }}</div>
            </div>
            <div>
                <div class="info-label">ID Pengguna</div>
                <div class="info-value">UID-{{ $order->user_id }}</div>
            </div>
        </div>
    </div>

    <div class="card-simple">
        <div class="card-title">Produk yang Dibeli</div>
        
        @if(isset($order->products) && $order->products->count() > 0)
            @foreach($order->products as $product)
                <div class="product-item">
                    <span class="prod-name">{{ $product->nama }}</span>
                    <span class="prod-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                </div>
            @endforeach
        @elseif(isset($order->product))
            <div class="product-item">
                <span class="prod-name">{{ $order->product->nama }}</span>
                <span class="prod-price">Rp {{ number_format($order->product->harga, 0, ',', '.') }}</span>
            </div>
        @else
            <div class="product-item">
                <span class="prod-name">Produk TRAYA</span>
                <span class="prod-price">Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</span>
            </div>
        @endif

        <div class="total-row">
            <span>Total Bayar</span>
            <span>Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="card-simple">
        <div class="card-title">Bukti Pembayaran</div>
        
        @if($order->bukti_pembayaran)
            <p class="info-label" style="margin-bottom: 8px;">Bukti yang sudah Anda unggah:</p>
            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" class="proof-img-preview" alt="Bukti Pembayaran">
            
            @if($order->status == 'pending')
                <p style="font-size: 12px; color: #666; margin-top: 12px; text-align: center;">
                    Ingin mengganti file? Silakan pilih file baru di bawah ini:
                </p>
            @endif
        @endif

        @if($order->status == 'pending')
            <form action="{{ route('order.upload-proof', $order->id) }}" method="POST" enctype="multipart/form-data" style="margin-top: 12px;">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="file" name="bukti_pembayaran" class="file-input" required accept="image/*">
                    <button type="submit" class="btn-submit">Kirim Bukti Pembayaran</button>
                </div>
            </form>
        @else
            <p style="font-size: 13px; color: #2e7d32; font-weight: 500; text-align: center; margin-top: 8px;">
                ✓ Pembayaran telah divalidasi. Anda tidak perlu mengunggah ulang bukti.
            </p>
        @endif
    </div>
</div>

</body>
</html>