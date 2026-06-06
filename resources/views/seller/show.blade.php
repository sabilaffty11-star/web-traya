<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Penjual - {{ $seller->name }} | TRAYA</title>
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
        
        .profile-header {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            background: #E86F2C;
            border-radius: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
        }
        
        .profile-info {
            flex: 1;
        }
        
        .profile-name {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }
        
        .profile-email {
            color: #666;
            margin-bottom: 15px;
        }
        
        .profile-stats {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        
        .stat-card {
            background: #f8f8f8;
            padding: 12px 20px;
            border-radius: 12px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #E86F2C;
        }
        
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        .btn-contact {
            background: #E86F2C;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }
        
        .products-section {
            margin: 40px 0;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #E86F2C;
            display: inline-block;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
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
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        
        .product-image {
            background: #f5f5f5;
            height: 200px;
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
        
        .product-category {
            font-size: 11px;
            color: #999;
            margin-bottom: 10px;
        }
        
        .btn-detail {
            display: inline-block;
            background: #E86F2C;
            color: white;
            padding: 6px 16px;
            text-decoration: none;
            border-radius: 20px;
            font-size: 12px;
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
            .profile-header {
                text-align: center;
                justify-content: center;
            }
            .profile-stats {
                justify-content: center;
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
            <a href="{{ route('products.index') }}">Kategori</a>
            <a href="#">Cara Kerja</a>
            <a href="#">Tentang Kami</a>
            <a href="#">Bantuan</a>
        </div>
        <div class="nav-auth">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
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
    <div class="profile-header">
        <div class="profile-avatar">
            👤
        </div>
        <div class="profile-info">
            <h1 class="profile-name">{{ $seller->name }}</h1>
            <div class="profile-email">{{ $seller->email }}</div>
            
            <div class="profile-stats">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalProducts }}</div>
                    <div class="stat-label">Total Produk</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $availableProducts }}</div>
                    <div class="stat-label">Tersedia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $soldProducts }}</div>
                    <div class="stat-label">Terjual</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Rp {{ number_format($totalValue, 0, ',', '.') }}</div>
                    <div class="stat-label">Total Nilai</div>
                </div>
            </div>
            
            @auth
                @if(auth()->id() != $seller->id)
                    <a href="#" class="btn-contact" onclick="alert('Fitur chat akan segera hadir! 📱')">💬 Hubungi Penjual</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-contact">🔒 Login untuk Hubungi Penjual</a>
            @endauth
        </div>
    </div>
    
    <div class="products-section">
        <h2 class="section-title">📦 Produk dari {{ $seller->name }}</h2>
        
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                        @else
                            📦
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $product->nama }}</h3>
                        <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                        <div class="product-category">{{ $product->kategori }}</div>
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
                <p style="font-size: 18px; color: #999;">😞 Belum ada produk dari penjual ini</p>
            </div>
        @endif
    </div>
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>