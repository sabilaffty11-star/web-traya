<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Barang - TRAYA</title>
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
        
        hr {
            border: none;
            border-top: 1px solid #e5e5e5;
        }
        
        .form-container {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .form-container h1 {
            color: #E86F2C;
            margin-bottom: 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #E86F2C;
        }
        
        .btn-submit {
            background: #E86F2C;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
        }
        
        .btn-submit:hover {
            background: #d45a1a;
        }
        
        .btn-cancel {
            display: inline-block;
            background: #f5f5f5;
            color: #666;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            text-align: center;
            margin-top: 10px;
        }
        
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
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
    <div class="form-container">
        <h1>Jual Barang Bekas</h1>
        <p style="color: #666; margin-bottom: 25px;">Isi form berikut untuk menjual barangmu</p>
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="nama">Nama Barang *</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Meja Kayu Jati">
            </div>
            
            <div class="form-group">
                <label for="Shop">Shop *</label>
                <select id="Shop" name="Shop" required>
                    <option value="">Pilih Shop</option>
                    <option value="Elektronik" {{ old('Shop') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                    <option value="Fashion" {{ old('Shop') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="Furniture" {{ old('Shop') == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                    <option value="Buku" {{ old('Shop') == 'Buku' ? 'selected' : '' }}>Buku</option>
                    <option value="Olahraga" {{ old('Shop') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                    <option value="Lainnya" {{ old('Shop') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="harga">Harga (Rp) *</label>
                <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required placeholder="Contoh: 250000">
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi *</label>
                <textarea id="deskripsi" name="deskripsi" required placeholder="Jelaskan kondisi barang, ukuran, warna, dll...">{{ old('deskripsi') }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="gambar">Foto Barang (Opsional)</label>
                <input type="file" id="gambar" name="gambar" accept="image/*">
                <p style="font-size: 12px; color: #999; margin-top: 5px;">Format: JPG, PNG, JPEG. Max 2MB</p>
            </div>
            
            <button type="submit" class="btn-submit">+ Jual Barang</button>
            <a href="{{ route('products.index') }}" class="btn-cancel" style="display: block; text-align: center;">Batal</a>
        </form>
    </div>
</div>

<div class="footer">
    © 2026 TRAYA - Barang Bekas, Cerita Baru.
</div>

</body>
</html>