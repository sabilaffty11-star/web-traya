<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Kerja - TRAYA</title>
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
        
        .page-header {
            margin: 40px 0 20px;
        }
        
        .page-header h1 {
            font-size: 36px;
            color: #E86F2C;
            margin-bottom: 10px;
        }
        
        .page-header p {
            color: #666;
            font-size: 16px;
        }
        
        .steps-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }
        
        .step-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        
        .step-card:hover {
            transform: translateY(-4px);
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            background: #E86F2C;
            color: white;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            margin: 0 auto 20px;
        }
        
        .step-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .step-desc {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
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
            .page-header h1 {
                font-size: 28px;
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
            <a href="{{ route('cara-kerja') }}">Cara Kerja</a>
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
    <div class="page-header">
        <h1>Cara Kerja TRAYA</h1>
        <p>Mudah, cepat, dan aman. Ikuti langkah-langkah berikut</p>
    </div>
    
    <div class="steps-container">
        <div class="step-card">
            <div class="step-number">1</div>
            <div class="step-title">Daftar Akun</div>
            <div class="step-desc">
                Buat akun gratis di TRAYA dengan email aktif. Proses cepat dan mudah.
            </div>
        </div>
        
        <div class="step-card">
            <div class="step-number">2</div>
            <div class="step-title">Jual Barang</div>
            <div class="step-desc">
                Upload foto, tulis deskripsi, dan tentukan harga untuk barang bekas Anda.
            </div>
        </div>
        
        <div class="step-card">
            <div class="step-number">3</div>
            <div class="step-title">Tunggu Pembeli</div>
            <div class="step-desc">
                Pembeli akan menghubungi Anda melalui chat. Jawab dengan cepat.
            </div>
        </div>
        
        <div class="step-card">
            <div class="step-number">4</div>
            <div class="step-title">Transaksi Aman</div>
            <div class="step-desc">
                Lakukan transaksi dengan aman. Tentukan metode pembayaran dan pengiriman.
            </div>
        </div>
    </div>
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>