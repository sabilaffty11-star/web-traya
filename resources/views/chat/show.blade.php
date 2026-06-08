<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat - {{ $chat->product->nama }} | TRAYA</title>
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
            max-width: 800px;
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
        
        .chat-header {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .chat-product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .chat-product-image {
            width: 50px;
            height: 50px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .chat-product-name {
            font-weight: 600;
            color: #333;
        }
        
        .chat-with {
            font-size: 12px;
            color: #888;
        }
        
        .back-link {
            color: #E86F2C;
            text-decoration: none;
        }
        
        .messages-container {
            background: white;
            border-radius: 16px;
            height: 500px;
            overflow-y: auto;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .message {
            margin-bottom: 15px;
            display: flex;
        }
        
        .message.sent {
            justify-content: flex-end;
        }
        
        .message.received {
            justify-content: flex-start;
        }
        
        .message-bubble {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 18px;
            font-size: 14px;
        }
        
        .message.sent .message-bubble {
            background: #E86F2C;
            color: white;
            border-bottom-right-radius: 4px;
        }
        
        .message.received .message-bubble {
            background: #f0f0f0;
            color: #333;
            border-bottom-left-radius: 4px;
        }
        
        .message-time {
            font-size: 10px;
            margin-top: 4px;
            color: #999;
            text-align: right;
        }
        
        .message.sent .message-time {
            text-align: right;
        }
        
        .message.received .message-time {
            text-align: left;
        }
        
        .message-sender {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #666;
        }
        
        .chat-input-container {
            background: white;
            border-radius: 16px;
            padding: 15px;
            display: flex;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .chat-input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 14px;
            outline: none;
        }
        
        .chat-input:focus {
            border-color: #E86F2C;
        }
        
        .send-btn {
            background: #E86F2C;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .send-btn:hover {
            background: #d45a1a;
        }
        
        .footer {
            text-align: center;
            padding: 24px 0;
            font-size: 12px;
            color: #aaa;
            border-top: 1px solid #e5e5e5;
            background: white;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .message-bubble {
                max-width: 85%;
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
                <a href="{{ route('chat.index') }}">💬 Pesan</a>
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
    <a href="{{ route('chat.index') }}" class="back-link">← Kembali ke Pesan</a>
    
    <div class="chat-header">
        <div class="chat-product-info">
            <div class="chat-product-image">
                @if($chat->product->gambar)
                    <img src="{{ asset('storage/' . $chat->product->gambar) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                @else
                    📦
                @endif
            </div>
            <div>
                <div class="chat-product-name">{{ $chat->product->nama }}</div>
                <div class="chat-with">
                    @php
                        $otherUser = $chat->buyer_id == auth()->id() ? $chat->seller : $chat->buyer;
                    @endphp
                    Chat dengan <strong>{{ $otherUser->name }}</strong>
                </div>
            </div>
        </div>
        <a href="{{ route('products.show', $chat->product->id) }}" style="color: #E86F2C; font-size: 13px;">Lihat Produk →</a>
    </div>
    
    <div class="messages-container" id="messages-container">
        @foreach($chat->messages as $message)
            <div class="message {{ $message->user_id == auth()->id() ? 'sent' : 'received' }}">
                <div class="message-bubble">
                    <div class="message-sender">{{ $message->user->name }}</div>
                    {{ $message->message }}
                    <div class="message-time">{{ $message->created_at->format('H:i') }}</div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="chat-input-container">
        <input type="text" id="message-input" class="chat-input" placeholder="Ketik pesan..." autocomplete="off">
        <button id="send-btn" class="send-btn">Kirim</button>
    </div>
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var chatId = {{ $chat->id }};
        var lastMessageId = {{ $chat->messages->last()->id ?? 0 }};
        
        // Scroll ke bawah
        var container = $('#messages-container');
        container.scrollTop(container[0].scrollHeight);
        
        // Kirim pesan
        $('#send-btn').click(function() {
            sendMessage();
        });
        
        $('#message-input').keypress(function(e) {
            if (e.which == 13) {
                sendMessage();
            }
        });
        
        function sendMessage() {
            var message = $('#message-input').val().trim();
            if (message == '') return;
            
            $.ajax({
                url: '{{ route("chat.send", $chat->id) }}',
                type: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Tambah pesan ke container
                        var messageHtml = `
                            <div class="message sent">
                                <div class="message-bubble">
                                    <div class="message-sender">${response.user.name}</div>
                                    ${response.message.message}
                                    <div class="message-time">Baru saja</div>
                                </div>
                            </div>
                        `;
                        container.append(messageHtml);
                        container.scrollTop(container[0].scrollHeight);
                        $('#message-input').val('');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
        
        // Refresh pesan setiap 3 detik
        setInterval(function() {
            $.ajax({
                url: '{{ route("chat.messages", $chat->id) }}',
                type: 'GET',
                success: function(messages) {
                    var currentMessageCount = container.find('.message').length;
                    if (messages.length > currentMessageCount) {
                        container.empty();
                        for (var i = 0; i < messages.length; i++) {
                            var msg = messages[i];
                            var isSent = msg.user_id == {{ auth()->id() }};
                            var messageHtml = `
                                <div class="message ${isSent ? 'sent' : 'received'}">
                                    <div class="message-bubble">
                                        <div class="message-sender">${msg.user.name}</div>
                                        ${msg.message}
                                        <div class="message-time">${new Date(msg.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}</div>
                                    </div>
                                </div>
                            `;
                            container.append(messageHtml);
                        }
                        container.scrollTop(container[0].scrollHeight);
                    }
                }
            });
        }, 3000);
    });
</script>

</body>
</html>