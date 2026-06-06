<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // ==================== HALAMAN PRODUK ====================
    
    // Halaman daftar produk dengan pencarian & filter
    public function index(Request $request)
    {
        $query = Product::where('status', 'tersedia');
        
        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        // Fitur Filter Kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }
        
        // Fitur Sorting
        if ($request->has('sort') && $request->sort != '') {
            switch ($request->sort) {
                case 'termurah':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('harga', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }
        
        $products = $query->paginate(12)->withQueryString();
        
        // Ambil daftar kategori untuk filter
        $kategoris = Product::where('status', 'tersedia')
                            ->select('kategori')
                            ->distinct()
                            ->pluck('kategori');
        
        return view('products.index', compact('products', 'kategoris'));
    }
    
    // Halaman detail produk
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    
    // ==================== HALAMAN PROFIL PENJUAL ====================
    
    // Halaman profil penjual (menampilkan semua produk dari penjual tertentu)
    public function sellerProfile($id)
    {
        $seller = User::findOrFail($id);
        $products = Product::where('user_id', $id)
                          ->where('status', 'tersedia')
                          ->latest()
                          ->paginate(12);
        
        // Statistik penjual
        $totalProducts = $seller->products()->count();
        $availableProducts = $seller->products()->where('status', 'tersedia')->count();
        $soldProducts = $seller->products()->where('status', 'terjual')->count();
        $totalValue = $seller->products()->sum('harga');
        
        return view('seller.show', compact('seller', 'products', 'totalProducts', 'availableProducts', 'soldProducts', 'totalValue'));
    }
    
    // ==================== CRUD PRODUK (BUTUH LOGIN) ====================
    
    // Form jual barang
    public function create()
    {
        return view('products.create');
    }
    
    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:100',
            'deskripsi' => 'required|min:10',
            'harga' => 'required|numeric|min:1000',
            'kategori' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        $product = new Product();
        $product->nama = $request->nama;
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->kategori = $request->kategori;
        $product->user_id = Auth::id();
        $product->status = 'tersedia';
        
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('products', 'public');
            $product->gambar = $path;
        }
        
        $product->save();
        
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }
    
    // Form edit produk
    public function edit($id)
    {
        $product = Product::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();
        return view('products.edit', compact('product'));
    }
    
    // Update produk
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();
        
        $request->validate([
            'nama' => 'required|min:3|max:100',
            'deskripsi' => 'required|min:10',
            'harga' => 'required|numeric|min:1000',
            'kategori' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        $product->nama = $request->nama;
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->kategori = $request->kategori;
        
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('products', 'public');
            $product->gambar = $path;
        }
        
        $product->save();
        
        return redirect()->route('products.show', $product->id)
                         ->with('success', 'Produk berhasil diupdate!');
    }
    
    // Hapus produk
    public function destroy($id)
    {
        $product = Product::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();
        $product->delete();
        
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}