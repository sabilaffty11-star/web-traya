<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Transfer - TRAYA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #fafafa; }
        .container { max-width: 600px; margin: 0 auto; padding: 40px 24px; }
        .card { background: white; border-radius: 16px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        h1 { color: #E86F2C; margin-bottom: 10px; }
        .bank-info { background: #f5f5f5; padding: 20px; border-radius: 12px; margin: 20px 0; }
        .bank-info h3 { margin-bottom: 10px; color: #333; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px; }
        .btn-submit { background: #E86F2C; color: white; border: none; padding: 12px 24px; border-radius: 30px; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Upload Bukti Transfer</h1>
        <p style="color: #666;">Silakan transfer ke rekening berikut dan upload buktinya</p>
        
        <div class="bank-info">
            <h3>Rekening Tujuan</h3>
            <p><strong>Bank BCA</strong><br>123-456-7890<br>a.n. TRAYA Official</p>
            <p style="margin-top: 10px;"><strong>Bank Mandiri</strong><br>987-654-3210<br>a.n. TRAYA Official</p>
            <p style="margin-top: 10px;"><strong>Total yang harus ditransfer:</strong><br>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
        </div>
        
        <form method="POST" action="{{ route('order.store-proof', $order->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Upload Bukti Transfer (JPG/PNG)</label>
                <input type="file" name="proof_image" accept="image/*" required>
            </div>
            <button type="submit" class="btn-submit">Upload Bukti</button>
        </form>
    </div>
</div>
</body>
</html>