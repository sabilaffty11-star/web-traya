<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Saya - TRAYA</title>
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
            max-width: 900px;
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
        
        hr {
            border: none;
            border-top: 1px solid #e5e5e5;
        }
        
        .chat-list {
            background: white;
            border-radius: 16px;
            margin: 20px 0;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .chat-item {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            text-decoration: none;
            transition: background 0.2s;
        }
        
        .chat-item:hover {
            background: #fafafa;
        }
        
        .chat-avatar {
            width: 50px;
            height: 50px;
            background: #E86F2C;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            margin-right: 15px;
        }
        
        .chat-info {
            flex: 1;
        }
        
        .chat-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }
        
        .chat-product {
            font-size: 12px;
            color: #E86F2C;
            margin-bottom: 4px;
        }
        
        .chat-last-message {
            font-size: 13px;
            color: #888;
        }
        
        .chat-time {
            font-size: 11px;
            color: #aaa;
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
    <h1 style="color: #E86F2C; margin: 20px 0;"> Pesan Saya</h1>
    
    @if($chats->count() > 0)
        <div class="chat-list">
            @foreach($chats as $chat)
                @php
                    $otherUser = $chat->buyer_id == auth()->id() ? $chat->seller : $chat->buyer;
                @endphp
                <a href="{{ route('chat.show', $chat->id) }}" class="chat-item">
                    <div class="chat-avatar">
                        {{ substr($otherUser->name, 0, 1) }}
                    </div>
                    <div class="chat-info">
                        <div class="chat-name">{{ $otherUser->name }}</div>
                        <div class="chat-product">{{ $chat->product->nama }}</div>
                        <div class="chat-last-message">
                            {{ $chat->lastMessage ? $chat->lastMessage->message : 'Mulai chat' }}
                        </div>
                    </div>
                    <div class="chat-time">
                        {{ $chat->updated_at->diffForHumans() }}
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p style="font-size: 18px; color: #999;"> Belum ada chat</p>
            <p style="color: #666; margin-top: 10px;">Mulai chat dengan penjual dari halaman produk</p>
            <a href="{{ route('products.index') }}" style="background: #E86F2C; color: white; padding: 10px 20px; border-radius: 25px; text-decoration: none; display: inline-block; margin-top: 15px;">Lihat Produk</a>
        </div>
    @endif
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>