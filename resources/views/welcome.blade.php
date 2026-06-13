<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAYA - Barang Bekas, Cerita Baru</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
            background: white;
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
        }
        
        .logo-area {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .logo-img {
            height: 35px;
            width: auto;
        }
        
        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #E86F2C;
            letter-spacing: -0.5px;
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
            margin: 0;
        }
        
        .hero {
            text-align: center;
            padding: 60px 0 50px;
        }
        
        .hero h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #222;
        }
        
        .hero h1 span {
            font-weight: 400;
            color: #E86F2C;
        }
        
        .hero p {
            font-size: 18px;
            color: #666;
            margin-bottom: 32px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
        }
        
        .btn-primary {
            padding: 10px 28px;
            background: #E86F2C;
            color: white;
            text-decoration: none;
            font-size: 14px;
            border-radius: 30px;
            border: none;
            transition: background 0.2s;
            display: inline-block;
        }
        
        .btn-primary:hover {
            background: #d45a1a;
        }
        
        .btn-secondary {
            padding: 10px 28px;
            background: white;
            color: #E86F2C;
            text-decoration: none;
            font-size: 14px;
            border-radius: 30px;
            border: 1.5px solid #E86F2C;
            transition: all 0.2s;
            display: inline-block;
        }
        
        .btn-secondary:hover {
            background: #FFF3EC;
        }
        
        .features {
            display: flex;
            justify-content: space-between;
            text-align: center;
            padding: 50px 0;
            gap: 40px;
        }
        
        .feature {
            flex: 1;
        }
        
        .feature h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #E86F2C;
        }
        
        .feature p {
            font-size: 13px;
            color: #888;
            line-height: 1.6;
        }
        
        .shop-local {
            text-align: center;
            padding: 60px 0;
        }
        
        .shop-illustration {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
        }
        
        .shop-text {
            text-align: left;
        }
        
        .shop-line {
            font-size: 55px;
            font-weight: 700;
            letter-spacing: 4px;
            line-height: 1.2;
        }
        
        .shop-line-orange {
            color: #E86F2C;
        }
        
        .shop-line-gray {
            color: #ccc;
        }
        
        .illustration-img {
            max-width: 180px;
            height: auto;
        }
        
        .about-section {
            padding: 60px 0;
            text-align: center;
            background: #fafafa;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .about-content h2 {
            font-size: 28px;
            color: #222;
            margin-bottom: 16px;
        }

        .about-content p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            padding: 24px 0;
            font-size: 12px;
            color: #aaa;
            border-top: 1px solid #e5e5e5;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .features {
                flex-direction: column;
                gap: 30px;
            }
            .shop-line {
                font-size: 35px;
            }
            .hero h1 {
                font-size: 32px;
            }
            .shop-illustration {
                flex-direction: column;
                text-align: center;
            }
            .shop-text {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="navbar">
        <div class="logo-area">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.style.display='none'">
            <a href="{{ route('home') }}" class="logo-text">TRAYA</a>
        </div>
        
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
    <div class="hero">
        <h1>Barang Bekas, <span>Cerita Baru</span></h1>
        <p>Temukan barang berkualitas dengan harga terjangkau<br>atau jual barang yang sudah tidak terpakai.</p>
        
        <div class="hero-buttons">
            @auth
                <a href="{{ route('products.index') }}" class="btn-primary">Mulai Belanja</a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">Daftar Sekarang</a>
                <a href="{{ route('products.index') }}" class="btn-secondary">Mulai Belanja</a>
            @endauth
        </div>
    </div>
</div>

<hr>

<div class="container">
    <div class="features">
        <div class="feature">
            <h3>Ramah Lingkungan</h3>
            <p>Kurang limbah, perpanjang umur barang.</p>
        </div>
        <div class="feature">
            <h3>Harga Terjangkau</h3>
            <p>Dapatkan produk berkualitas dengan harga lebih murah.</p>
        </div>
        <div class="feature">
            <h3>Transaksi Aman</h3>
            <p>Sistem verifikasi & ulasan terpercaya.</p>
        </div>
    </div>
</div>

<hr>

<div class="container">
    <div class="shop-local">
        <div class="shop-illustration">
            <div class="shop-text">
                <div class="shop-line shop-line-orange">SHOP</div>
                <div class="shop-line shop-line-gray">SMALL</div>
                <div class="shop-line shop-line-orange">SHOP</div>
                <div class="shop-line shop-line-gray">LOCAL</div>
            </div>
            <img src="{{ asset('image/ilustrasi tas Shop Small.png') }}" alt="Ilustrasi Tas" class="illustration-img" onerror="this.style.display='none'">
        </div>
    </div>
</div>

<hr>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>