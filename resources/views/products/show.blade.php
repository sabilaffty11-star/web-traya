<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama }} - TRAYA</title>
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
            max-width: 1100px;
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
        
        .nav-auth a:hover {
            color: #E86F2C;
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
        
        .back-link {
            margin: 20px 0;
            display: inline-block;
            color: #E86F2C;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .product-image {
            background: #f5f5f5;
            border-radius: 12px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }
        
        .product-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #333;
        }
        
        .product-price {
            font-size: 32px;
            font-weight: bold;
            color: #E86F2C;
            margin-bottom: 16px;
        }
        
        .product-category {
            display: inline-block;
            background: #f0f0f0;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 20px;
        }
        
        .product-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            margin-left: 10px;
        }
        
        .status-tersedia {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .status-terjual {
            background: #ffebee;
            color: #c62828;
        }
        
        .product-desc {
            font-size: 16px;
            color: #555;
            line-height: 1.7;
            margin-bottom: 30px;
        }
        
        /* Tombol Beli / Chat */
        .btn-buy {
            background: #E86F2C;
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }
        
        .btn-buy:hover {
            background: #d45a1a;
        }
        
        .btn-buy-disabled {
            background: #ccc;
            color: #666;
            padding: 14px 30px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: not-allowed;
            width: 100%;
            text-align: center;
            display: inline-block;
        }
        
        /* Tombol Edit & Delete (hanya untuk pemilik) */
        .btn-edit {
            background: #2196f3;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-right: 10px;
        }
        
        .btn-edit:hover {
            background: #0b7dda;
        }
        
        .btn-delete {
            background: #f44336;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        
        .btn-delete:hover {
            background: #d32f2f;
        }
        
        /* Pesan error/alert */
        .alert-warning {
            background: #fff3e0;
            border: 1px solid #ffb74d;
            color: #e65100;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .seller-info {
            background: #f8f8f8;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }
        
        .seller-info a {
            color: #E86F2C;
            text-decoration: none;
        }
        
        .seller-info a:hover {
            text-decoration: underline;
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
            .product-detail {
                grid-template-columns: 1fr;
            }
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .product-title {
                font-size: 22px;
            }
            .product-price {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Navbar -->
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
            @auth
                <a href="{{ route('Profil') }}">Profil</a>
                <a href="{{ route('chat.index') }}">💬 Pesan</a>
                <a href="{{ route('products.create') }}" class="btn-jual">+ Jual Barang</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </div>
</div>

<hr>

<div class="container">
    <!-- Back Link -->
    <a href="{{ route('products.index') }}" class="back-link">← Kembali ke Daftar Produk</a>
    
    <!-- Product Detail -->
    <div class="product-detail">
        <!-- Product Image -->
        <div class="product-image">
            @if($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
            @else
                📦
            @endif
        </div>
        
        <!-- Product Info -->
        <div>
            <h1 class="product-title">{{ $product->nama }}</h1>
            <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
            <div>
                <span class="product-category">{{ $product->Shop }}</span>
                <span class="product-status status-{{ $product->status === 'tersedia' ? 'tersedia' : 'terjual' }}">
                    {{ $product->status === 'tersedia' ? '✓ Tersedia' : '✗ Terjual' }}
                </span>
            </div>
            
            <!-- Deskripsi -->
            <div class="product-desc">
                <h4 style="margin: 20px 0 10px; color: #333;">Deskripsi</h4>
                <p>{{ $product->deskripsi }}</p>
            </div>
            
            
@if($product->status === 'tersedia')
    @auth
        @if(auth()->id() === $product->user_id)
            <div class="alert-warning" style="text-align: center; background-color: #fff3cd; color: #856404; padding: 12px; border-radius: 8px; border: 1px solid #ffeeba; width: 100%;">
                Ini adalah produk Anda sendiri.
            </div>
        @else
            <div class="action-buttons-group" style="display: flex; gap: 12px; width: 100%; margin-top: 15px;">
                <a href="{{ route('order.checkout', $product->id) }}" class="btn-primary" style="flex: 1; text-align: center; background: #E86F2C; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500;">
                    Beli Sekarang
                </a>
                
                <a href="{{ route('chat.start', $product->id) }}" class="btn-secondary" style="flex: 1; text-align: center; background: white; color: #E86F2C; padding: 12px 20px; border-radius: 30px; text-decoration: none; border: 1.5px solid #E86F2C; font-weight: 500;">
                    Chat Penjual
                </a>
            </div>
        @endif
    @else
        <a href="{{ route('login') }}" class="btn-primary" style="display: block; text-align: center; background: #E86F2C; color: white; padding: 12px; border-radius: 30px; text-decoration: none; font-weight: 500; width: 100%;">
            Login untuk Membeli
        </a>
    @endauth
@else
    <div class="btn-buy-disabled" style="text-align: center; background: #e2e8f0; color: #64748b; padding: 12px; border-radius: 30px; font-weight: 500; cursor: not-allowed; width: 100%;">
        ✗ Barang Sudah Terjual
    </div>
@endif
            
            
            @auth
                @if(auth()->id() === $product->user_id)
                    <div style="margin-top: 20px;">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn-edit"> Edit Produk</a>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')"> Hapus Produk</button>
                        </form>
                    </div>
                @endif
            @endauth
            
            <!-- Informasi Penjual -->
            <div class="seller-info">
                <strong> Informasi Penjual</strong>
                <p style="margin-top: 8px;">
                    <a href="{{ route('seller.show', $product->user_id) }}">
                        {{ $product->user->name ?? 'Unknown' }}
                    </a>
                </p>
                <p style="color: #999; font-size: 12px; margin-top: 8px;">
                    Terdaftar di TRAYA
                </p>
                <a href="{{ route('seller.show', $product->user_id) }}" style="color: #E86F2C; font-size: 13px; text-decoration: none; margin-top: 10px; display: inline-block;">
                    Lihat semua produk penjual →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>