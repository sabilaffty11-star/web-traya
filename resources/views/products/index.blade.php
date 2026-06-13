<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - TRAYA</title>
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
        
        .nav-menu a:hover, .nav-menu a.active {
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
        
        .filter-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }
        
        .filter-group {
            flex: 1;
            min-width: 150px;
        }
        
        .filter-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
        }
        
        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #E86F2C;
        }
        
        .btn-filter {
            background: #E86F2C;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-reset {
            background: #f5f5f5;
            color: #666;
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        
        .search-results {
            margin: 15px 0;
            padding: 10px;
            background: #fff3ec;
            border-radius: 8px;
            color: #E86F2C;
            font-size: 14px;
        }
        
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .products-header h1 {
            color: #E86F2C;
            font-size: 28px;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        
        .product-image {
            background: #f5f5f5;
            height: 220px;
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
            padding: 16px;
        }
        
        .product-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        
        .product-price {
            color: #E86F2C;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 8px;
        }
        
        .product-category {
            font-size: 12px;
            color: #999;
            margin-bottom: 12px;
        }
        
        .product-desc {
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        
        .btn-detail {
            display: inline-block;
            background: #E86F2C;
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 25px;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }
        
        .btn-detail:hover {
            background: #d45a1a;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 12px;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 30px 0;
        }
        
        .pagination a, .pagination span {
            padding: 8px 14px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            border-radius: 6px;
        }
        
        .pagination .active {
            background: #E86F2C;
            color: white;
            border-color: #E86F2C;
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
            .products-header {
                flex-direction: column;
                text-align: center;
            }
            .filter-form {
                flex-direction: column;
            }
            .filter-group {
                width: 100%;
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
            @auth
                <a href="{{ route('Profil') }}">Profil</a>
                <a href="{{ route('chat.index') }}">Pesan</a>
                <a href="{{ route('products.create') }}" class="btn-jual">Jual Barang</a>
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
    <div class="filter-section">
        <form method="GET" action="{{ route('products.index') }}" class="filter-form">
            <div class="filter-group">
                <label>Cari Produk</label>
                <input type="text" name="search" placeholder="Cari nama atau deskripsi..." value="{{ request('search') }}">
            </div>
            
            <div class="filter-group">
                <label>Shop</label>
                <select name="Shop">
                    <option value="">Semua Shop</option>
                    @foreach($Shops as $kat)
                        <option value="{{ $kat }}" {{ request('Shop') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-group">
                <label>Urutkan</label>
                <select name="sort">
                    <option value="">Terbaru</option>
                    <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                    <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
                </select>
            </div>
            
            <div class="filter-group">
                <button type="submit" class="btn-filter">Cari</button>
                <a href="{{ route('products.index') }}" class="btn-reset">Reset</a>
            </div>
        </form>
        
        @if(request('search') || request('Shop') || request('sort'))
            <div class="search-results">
                Menampilkan hasil untuk:
                @if(request('search')) <strong>"{{ request('search') }}"</strong> @endif
                @if(request('Shop')) - Shop: <strong>{{ request('Shop') }}</strong> @endif
                @if(request('sort')) - Urutan: <strong>
                    @if(request('sort') == 'termurah') Termurah
                    @elseif(request('sort') == 'termahal') Termahal
                    @else Terbaru
                    @endif
                </strong> @endif
                <a href="{{ route('products.index') }}" style="float: right; color: #E86F2C;">Hapus filter</a>
            </div>
        @endif
    </div>
    
    <div class="products-header">
        <h1>Semua Produk</h1>
        <div>Menampilkan {{ $products->total() }} produk</div>
    </div>
    
    @if($products->count() > 0)
        <div class="products-grid">
            @foreach($products as $product)
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
                    <div class="product-category">{{ $product->Shop }}</div>
                    <p class="product-desc">{{ Str::limit($product->deskripsi, 80) }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="pagination">
            {{ $products->links() }}
        </div>
    @else
        <div class="empty-state">
            <p style="font-size: 18px; color: #999;">Produk tidak ditemukan</p>
            <p style="color: #666; margin-top: 10px;">Coba kata kunci lain atau reset filter</p>
            <a href="{{ route('products.index') }}" class="btn-detail" style="margin-top: 15px; display: inline-block;">Reset Filter</a>
        </div>
    @endif
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>