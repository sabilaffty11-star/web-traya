<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show($id)
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
}