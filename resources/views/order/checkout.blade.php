<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - TRAYA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #fafafa; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 24px; }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; background: white; }
        .logo-text { font-size: 24px; font-weight: 700; color: #E86F2C; text-decoration: none; }
        hr { border: none; border-top: 1px solid #e5e5e5; }
        .card { background: white; border-radius: 16px; padding: 30px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        h1 { color: #E86F2C; margin-bottom: 20px; font-size: 24px; }
        .product-info { display: flex; gap: 20px; align-items: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .product-image { width: 100px; height: 100px; background: #f5f5f5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 40px; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; border-radius: 12px; }
        .product-details h3 { font-size: 18px; margin-bottom: 5px; }
        .product-price { color: #E86F2C; font-size: 20px; font-weight: bold; margin-top: 8px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #333; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px 16px; border: 1px solid #ddd; border-radius: 12px; font-size: 14px; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #E86F2C; }
        .payment-options { display: flex; gap: 20px; margin: 15px 0; flex-wrap: wrap; }
        .payment-option { flex: 1; padding: 15px; border: 2px solid #e0e0e0; border-radius: 12px; text-align: center; cursor: pointer; transition: all 0.2s; }
        .payment-option.selected { border-color: #E86F2C; background: #fff3ec; }
        .payment-option input { display: none; }
        .payment-option label { cursor: pointer; display: block; font-weight: 500; }
        .btn-submit { background: #E86F2C; color: white; border: none; padding: 14px 30px; border-radius: 30px; font-size: 16px; font-weight: 600; cursor: pointer; width: 100%; }
        .btn-submit:hover { background: #d45a1a; }
        .btn-back { background: #f5f5f5; color: #666; padding: 10px 20px; border-radius: 25px; text-decoration: none; display: inline-block; margin-top: 15px; text-align: center; }
        .total { font-size: 20px; font-weight: bold; text-align: right; border-top: 1px solid #eee; padding-top: 15px; margin-top: 15px; }
        .error { background: #ffebee; color: #c62828; padding: 12px; border-radius: 12px; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container">
    <div class="navbar">
        <a href="{{ route('home') }}" class="logo-text">TRAYA</a>
    </div>
</div>
<hr>

<div class="container">
    <div class="card">
        <h1>Checkout Produk</h1>
        
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
        <div class="product-info">
            <div class="product-image">
                @if($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                @else
                    📦
                @endif
            </div>
            <div class="product-details">
                <h3>{{ $product->nama }}</h3>
                <p style="color: #888;">{{ $product->kategori }}</p>
                <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('order.store', $product->id) }}">
            @csrf
            
            <div class="form-group">
                <label>Alamat Pengiriman *</label>
                <textarea name="shipping_address" rows="3" required placeholder="Jalan, Kota, Kode Pos">{{ old('shipping_address') }}</textarea>
            </div>
            
            <div class="form-group">
                <label>Nomor Telepon *</label>
                <input type="tel" name="phone_number" value="{{ old('phone_number') }}" required placeholder="081234567890">
            </div>
            
            <div class="form-group">
                <label>Metode Pembayaran *</label>
                <div class="payment-options">
                    <div class="payment-option" onclick="selectPayment('cod')">
                        <input type="radio" name="payment_method" value="cod" id="cod" required>
                        <label for="cod">💰 COD (Bayar di Tempat)</label>
                    </div>
                    <div class="payment-option" onclick="selectPayment('transfer')">
                        <input type="radio" name="payment_method" value="transfer" id="transfer" required>
                        <label for="transfer">🏦 Transfer Bank (BCA/Mandiri/BRI)</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Catatan (Opsional)</label>
                <textarea name="notes" rows="2" placeholder="Contoh: Tolong dibungkus rapi">{{ old('notes') }}</textarea>
            </div>
            
            <div class="total">
                Total: Rp {{ number_format($product->harga, 0, ',', '.') }}
            </div>
            
            <button type="submit" class="btn-submit">Buat Pesanan</button>
            <a href="{{ route('products.show', $product->id) }}" class="btn-back" style="display: block; text-align: center;">← Kembali</a>
        </form>
    </div>
</div>

<script>
    function selectPayment(method) {
        document.querySelectorAll('.payment-option').forEach(option => {
            option.classList.remove('selected');
        });
        if (method === 'cod') {
            document.querySelector('.payment-option:first-child').classList.add('selected');
            document.getElementById('cod').checked = true;
        } else {
            document.querySelector('.payment-option:last-child').classList.add('selected');
            document.getElementById('transfer').checked = true;
        }
    }
</script>

</body>
</html>