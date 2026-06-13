<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - TRAYA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #fafafa;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            flex-wrap: wrap;
            gap: 16px;
            background: white;
        }
        
        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #E86F2C;
            text-decoration: none;
        }
        
        .nav-menu {
            display: flex;
            gap: 28px;
            font-size: 14px;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: #333;
        }
        
        .nav-menu a:hover {
            color: #E86F2C;
        }
        
        .nav-auth {
            display: flex;
            gap: 20px;
            font-size: 14px;
        }
        
        .nav-auth a {
            text-decoration: none;
            color: #333;
        }
        
        .btn-jual {
            background: #E86F2C;
            color: white !important;
            padding: 8px 16px;
            border-radius: 20px;
        }
        
        hr {
            border: none;
            border-top: 1px solid #e5e5e5;
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, #E86F2C 0%, #f09b48 100%);
            border-radius: 20px;
            padding: 30px;
            margin: 20px 0;
            color: white;
        }
        
        .welcome-banner h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }
        
        .welcome-banner p {
            opacity: 0.9;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #E86F2C;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
            margin-top: 8px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .btn-primary {
            background: #E86F2C;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
        }
        
        .btn-primary:hover {
            background: #d45a1a;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        
        .product-card:hover {
            transform: translateY(-4px);
        }
        
        .product-image {
            background: #f5f5f5;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info {
            padding: 15px;
        }
        
        .product-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        
        .product-price {
            color: #E86F2C;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 8px;
        }
        
        .product-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            margin-bottom: 10px;
        }
        
        .status-tersedia {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .status-terjual {
            background: #ffebee;
            color: #c62828;
        }
        
        .product-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .btn-edit {
            background: #2196f3;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 12px;
        }
        
        .btn-edit:hover {
            background: #0b7dda;
        }
        
        .btn-delete {
            background: #f44336;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }
        
        .btn-delete:hover {
            background: #d32f2f;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 12px;
        }
        
        .footer {
            text-align: center;
            padding: 24px 0;
            font-size: 12px;
            color: #aaa;
            border-top: 1px solid #e5e5e5;
            margin-top: 40px;
            background: white;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .section-title {
                flex-direction: column;
                text-align: center;
            }
        }
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
        
        <div class="nav-auth">
            <a href="{{ route('Profil') }}">Profil</a>
            <a href="{{ route('chat.index') }}">Pesan</a>
            <a href="{{ route('products.create') }}" class="btn-jual">Jual Barang</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
            </form>
        </div>
    </div>
</div>

<hr>

<div class="container">
    <div class="welcome-banner">
        <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
        <p>Kelola produk dan transaksi Anda di sini</p>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ Auth::user()->products->count() }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ Auth::user()->products->where('status', 'tersedia')->count() }}</div>
            <div class="stat-label">Produk Tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">Rp {{ number_format(Auth::user()->products->sum('harga'), 0, ',', '.') }}</div>
            <div class="stat-label">Total Nilai</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ Auth::user()->chatsAsSeller->count() + Auth::user()->chatsAsBuyer->count() }}</div>
            <div class="stat-label">Total Chat</div>
        </div>
    </div>
    
    <div class="section-title">
        <span>Produk Saya</span>
        <a href="{{ route('products.create') }}" class="btn-primary">Jual Barang Baru</a>
    </div>
    
    @if(Auth::user()->products->count() > 0)
        <div class="products-grid">
            @foreach(Auth::user()->products as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                    @else
                        Gambar
                    @endif
                </div>
                <div class="product-info">
                    <h3 class="product-title">{{ $product->nama }}</h3>
                    <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                    <span class="product-status status-{{ $product->status === 'tersedia' ? 'tersedia' : 'terjual' }}">
                        {{ $product->status === 'tersedia' ? 'Tersedia' : 'Terjual' }}
                    </span>
                    <div class="product-actions">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-edit" style="background: #4caf50;">Lihat</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">Edit</a>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p style="font-size: 18px; color: #999;">Belum ada produk yang dijual</p>
            <p style="color: #666; margin-top: 10px;">Mulai jual barang bekas Anda sekarang!</p>
            <a href="{{ route('products.create') }}" class="btn-primary" style="display: inline-block; margin-top: 15px;">Jual Barang</a>
        </div>
    @endif
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>