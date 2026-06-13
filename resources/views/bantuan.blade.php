<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan - TRAYA</title>
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
        
        .faq-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin: 30px 0;
        }
        
        .faq-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .faq-question {
            font-size: 18px;
            font-weight: 600;
            color: #E86F2C;
            margin-bottom: 10px;
        }
        
        .faq-answer {
            color: #666;
            line-height: 1.6;
            font-size: 14px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        
        .contact-section {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .contact-title {
            font-size: 24px;
            font-weight: 600;
            color: #E86F2C;
            margin-bottom: 20px;
        }
        
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        
        .contact-item {
            text-align: center;
        }
        
        .contact-label {
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
        }
        
        .contact-value {
            font-size: 16px;
            color: #333;
            font-weight: 500;
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
            .contact-info {
                flex-direction: column;
                gap: 15px;
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
    <div class="page-header">
        <h1>Pusat Bantuan</h1>
        <p>Pertanyaan yang sering diajukan dan cara menghubungi kami</p>
    </div>
    
    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question">Bagaimana cara menjual barang di TRAYA?</div>
            <div class="faq-answer">
                Untuk menjual barang, Anda perlu mendaftar akun terlebih dahulu. Setelah login, klik tombol "Jual Barang" di menu navigasi. Isi form dengan lengkap termasuk foto, deskripsi, dan harga barang. Setelah itu, barang Anda akan langsung tampil di halaman produk.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">Apakah pendaftaran di TRAYA gratis?</div>
            <div class="faq-answer">
                Ya, pendaftaran di TRAYA sepenuhnya gratis. Anda bisa langsung mendaftar menggunakan email aktif tanpa biaya apapun.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">Bagaimana cara menghubungi penjual?</div>
            <div class="faq-answer">
                Setelah login, buka halaman detail produk yang Anda minati, lalu klik tombol "Chat Penjual". Anda bisa bertanya langsung mengenai produk tersebut melalui fitur chat.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">Apakah TRAYA menjamin keamanan transaksi?</div>
            <div class="faq-answer">
                TRAYA menyediakan fitur chat dan verifikasi akun untuk membantu keamanan transaksi. Namun, kami menyarankan untuk bertemu di tempat umum atau menggunakan rekber jika transaksi nominal besar.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">Bagaimana cara menghapus produk yang sudah terjual?</div>
            <div class="faq-answer">
                Anda bisa mengubah status produk menjadi "Terjual" atau menghapus produk melalui menu Profil atau halaman edit produk.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">Berapa lama produk saya akan tampil?</div>
            <div class="faq-answer">
                Produk Anda akan langsung tampil setelah berhasil diupload. Produk akan tetap tampil sampai Anda menghapusnya atau mengubah status menjadi terjual.
            </div>
        </div>
    </div>
    
    <div class="contact-section">
        <div class="contact-title">Hubungi Kami</div>
        <div class="contact-info">
            <div class="contact-item">
                <div class="contact-label">Email</div>
                <div class="contact-value">support@traya.com</div>
            </div>
            <div class="contact-item">
                <div class="contact-label">WhatsApp</div>
                <div class="contact-value">0812-3456-7890</div>
            </div>
            <div class="contact-item">
                <div class="contact-label">Jam Operasional</div>
                <div class="contact-value">Senin - Jumat, 09:00 - 17:00</div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>