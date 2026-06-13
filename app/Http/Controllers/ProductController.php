<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Product::where('status', 'tersedia');
        
        
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        
        if ($request->has('Shop') && $request->Shop != '') {
            $query->where('Shop', $request->Shop);
        }
        
       
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
        
        
        $Shops = Product::where('status', 'tersedia')
                            ->select('Shop')
                            ->distinct()
                            ->pluck('Shop');
        
        return view('products.index', compact('products', 'Shops'));
    }
    
        public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    
    
    public function sellerProfile($id)
    {
        $seller = User::findOrFail($id);
        $products = Product::where('user_id', $id)
                          ->where('status', 'tersedia')
                          ->latest()
                          ->paginate(12);
        
        
        $totalProducts = $seller->products()->count();
        $availableProducts = $seller->products()->where('status', 'tersedia')->count();
        $soldProducts = $seller->products()->where('status', 'terjual')->count();
        $totalValue = $seller->products()->sum('harga');
        
        return view('seller.show', compact('seller', 'products', 'totalProducts', 'availableProducts', 'soldProducts', 'totalValue'));
    }
    
    
    public function create()
    {
        return view('products.create');
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:100',
            'deskripsi' => 'required|min:10',
            'harga' => 'required|numeric|min:1000',
            'Shop' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        $product = new Product();
        $product->nama = $request->nama;
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->Shop = $request->Shop;
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
    
    
    public function edit($id)
    {
        
        $product = Product::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();
        
        return view('products.edit', compact('product'));
    }
    
    
    public function update(Request $request, $id)
    {
        
        $product = Product::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();
        
        $request->validate([
            'nama' => 'required|min:3|max:100',
            'deskripsi' => 'required|min:10',
            'harga' => 'required|numeric|min:1000',
            'Shop' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        $product->nama = $request->nama;
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->Shop = $request->Shop;
        
        if ($request->hasFile('gambar')) {
           
            if ($product->gambar && file_exists(storage_path('app/public/' . $product->gambar))) {
                unlink(storage_path('app/public/' . $product->gambar));
            }
            $path = $request->file('gambar')->store('products', 'public');
            $product->gambar = $path;
        }
        
        $product->save();
        
        return redirect()->route('products.show', $product->id)
                         ->with('success', 'Produk berhasil diupdate!');
    }
    
    
    public function destroy($id)
    {
        
        $product = Product::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();
        
        
        if ($product->gambar && file_exists(storage_path('app/public/' . $product->gambar))) {
            unlink(storage_path('app/public/' . $product->gambar));
        }
        
        $product->delete();
        
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}