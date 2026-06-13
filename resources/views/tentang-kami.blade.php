<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - TRAYA</title>
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
        
        .about-content {
            background: white;
            border-radius: 16px;
            padding: 40px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .about-text {
            color: #444;
            line-height: 1.8;
            font-size: 16px;
        }
        
        .about-text p {
            margin-bottom: 20px;
        }
        
        .mission-vision {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin: 40px 0;
        }
        
        .mission-card, .vision-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .card-title {
            font-size: 24px;
            font-weight: 600;
            color: #E86F2C;
            margin-bottom: 15px;
        }
        
        .card-text {
            color: #666;
            line-height: 1.6;
        }
        
        .values-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }
        
        .value-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .value-title {
            font-size: 18px;
            font-weight: 600;
            color: #E86F2C;
            margin-bottom: 10px;
        }
        
        .value-desc {
            font-size: 13px;
            color: #666;
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
            .mission-vision {
                grid-template-columns: 1fr;
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
            <a href="{{ route('products.index') }}">Kategori</a>
            <a href="{{ route('cara-kerja') }}">Cara Kerja</a>
            <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
            <a href="{{ route('bantuan') }}">Bantuan</a>
        </div>
        <div class="nav-auth">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
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
        <h1>Tentang TRAYA</h1>
        <p>Barang Bekas, Cerita Baru</p>
    </div>
    
    <div class="about-content">
        <div class="about-text">
            <p>TRAYA adalah platform jual beli barang bekas yang lahir dari kepedulian terhadap lingkungan dan keinginan untuk memberikan nilai baru pada barang-barang yang masih layak pakai.</p>
            <p>Kami percaya bahwa setiap barang memiliki cerita dan masih bisa bermanfaat bagi orang lain. Melalui TRAYA, kami ingin membantu mengurangi limbah barang bekas sekaligus membantu masyarakat mendapatkan barang berkualitas dengan harga terjangkau.</p>
            <p>Didirikan pada tahun 2024, TRAYA telah membantu ribuan orang menjual barang bekas mereka dan menemukan barang yang mereka butuhkan dengan harga bersahabat.</p>
        </div>
    </div>
    
    <div class="mission-vision">
        <div class="mission-card">
            <div class="card-title">Misi Kami</div>
            <div class="card-text">
                Mengurangi limbah barang bekas dengan memfasilitasi jual beli barang bekas yang mudah, aman, dan terpercaya.
            </div>
        </div>
        <div class="vision-card">
            <div class="card-title">Visi Kami</div>
            <div class="card-text">
                Menjadi platform jual beli barang bekas terbesar di Indonesia yang mendukung gaya hidup berkelanjutan.
            </div>
        </div>
    </div>
    
    <div class="values-container">
        <div class="value-card">
            <div class="value-title">Ramah Lingkungan</div>
            <div class="value-desc">Mengurangi limbah dengan memperpanjang umur barang</div>
        </div>
        <div class="value-card">
            <div class="value-title">Terjangkau</div>
            <div class="value-desc">Barang berkualitas dengan harga bersahabat</div>
        </div>
        <div class="value-card">
            <div class="value-title">Aman</div>
            <div class="value-desc">Sistem verifikasi dan ulasan terpercaya</div>
        </div>
        <div class="value-card">
            <div class="value-title">Mudah</div>
            <div class="value-desc">Proses jual beli yang simpel dan cepat</div>
        </div>
    </div>
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>