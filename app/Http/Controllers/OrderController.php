<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Tampilkan halaman checkout
    public function checkout($productId)
    {
        $product = Product::findOrFail($productId);
        
        // Cek apakah produk milik sendiri
        if ($product->user_id == Auth::id()) {
            return redirect()->route('products.show', $productId)
                             ->with('error', 'Anda tidak bisa membeli produk sendiri!');
        }
        
        // Cek apakah produk masih tersedia
        if ($product->status != 'tersedia') {
            return redirect()->route('products.show', $productId)
                             ->with('error', 'Produk sudah tidak tersedia!');
        }
        
        return view('order.checkout', compact('product'));
    }
    
    // Proses order
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        $request->validate([
            'payment_method' => 'required|in:cod,transfer',
            'shipping_address' => 'required|min:10',
            'phone_number' => 'required|min:10|max:15',
            'notes' => 'nullable|max:500'
        ]);
        
        DB::beginTransaction();
        
        try {
            // Buat order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'buyer_id' => Auth::id(),
                'seller_id' => $product->user_id,
                'total_amount' => $product->harga,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method == 'cod' ? 'pending' : 'waiting_confirmation',
                'order_status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'phone_number' => $request->phone_number,
                'notes' => $request->notes
            ]);
            
            // Buat order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->nama,
                'product_price' => $product->harga,
                'quantity' => 1,
                'subtotal' => $product->harga
            ]);
            
            DB::commit();
            
            // Update status produk menjadi terjual
            $product->status = 'terjual';
            $product->save();
            
            return redirect()->route('order.success', $order->id)
                             ->with('success', 'Pesanan berhasil dibuat!');
                             
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }
    
    // Halaman sukses
    public function success($orderId)
    {
        $order = Order::with(['items.product', 'seller'])->findOrFail($orderId);
        
        // Pastikan order milik user yang login
        if ($order->buyer_id != Auth::id()) {
            abort(403);
        }
        
        return view('order.success', compact('order'));
    }
    
    // Halaman upload bukti transfer
    public function uploadProof($orderId)
    {
        $order = Order::where('id', $orderId)
                      ->where('buyer_id', Auth::id())
                      ->where('payment_method', 'transfer')
                      ->where('payment_status', 'waiting_confirmation')
                      ->firstOrFail();
        
        return view('order.upload-proof', compact('order'));
    }
    
    // Proses upload bukti transfer
    public function storeProof(Request $request, $orderId)
    {
        $request->validate([
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        $order = Order::where('id', $orderId)
                      ->where('buyer_id', Auth::id())
                      ->firstOrFail();
        
        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('proofs', 'public');
            $order->proof_of_payment = $path;
            $order->payment_status = 'waiting_confirmation';
            $order->save();
        }
        
        return redirect()->route('order.detail', $orderId)
                         ->with('success', 'Bukti transfer telah diupload, menunggu konfirmasi penjual.');
    }
    
    // Detail order
    public function detail($orderId)
    {
        $order = Order::with(['items.product', 'buyer', 'seller'])
                      ->where(function($query) use ($orderId) {
                          $query->where('buyer_id', Auth::id())
                                ->orWhere('seller_id', Auth::id());
                      })
                      ->findOrFail($orderId);
        
        return view('order.detail', compact('order'));
    }
    
    // Daftar pesanan saya (pembeli)
    public function myOrders()
    {
        $orders = Order::where('buyer_id', Auth::id())
                       ->with(['seller', 'items.product'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);
        
        return view('order.my-orders', compact('orders'));
    }
    
    // Daftar pesanan masuk (penjual)
    public function incomingOrders()
    {
        $orders = Order::where('seller_id', Auth::id())
                       ->with(['buyer', 'items.product'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);
        
        return view('order.incoming-orders', compact('orders'));
    }
    
    // Update status pesanan (untuk penjual)
    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
                      ->where('seller_id', Auth::id())
                      ->firstOrFail();
        
        $request->validate([
            'order_status' => 'required|in:processed,shipped,delivered,completed,cancelled'
        ]);
        
        $order->order_status = $request->order_status;
        
        if ($request->order_status == 'cancelled') {
            // Kembalikan status produk menjadi tersedia
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->status = 'tersedia';
                    $product->save();
                }
            }
        }
        
        if ($request->order_status == 'delivered' && $order->payment_method == 'cod') {
            $order->payment_status = 'paid';
        }
        
        $order->save();
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate.');
    }
    
    // Konfirmasi pembayaran (untuk penjual)
    public function confirmPayment($orderId)
    {
        $order = Order::where('id', $orderId)
                      ->where('seller_id', Auth::id())
                      ->where('payment_method', 'transfer')
                      ->where('payment_status', 'waiting_confirmation')
                      ->firstOrFail();
        
        $order->payment_status = 'paid';
        $order->paid_at = now();
        $order->save();
        
        return redirect()->back()->with('success', 'Pembayaran dikonfirmasi. Pesanan siap diproses.');
    }
}