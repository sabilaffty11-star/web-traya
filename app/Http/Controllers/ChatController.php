<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Hapus constructor, ganti dengan middleware di route
    
    // Mulai chat atau ambil chat yang sudah ada
    public function startChat($productId)
    {
        $product = Product::findOrFail($productId);
        
        // Cek apakah sudah ada chat
        $chat = Chat::where('product_id', $productId)
                    ->where('buyer_id', Auth::id())
                    ->where('seller_id', $product->user_id)
                    ->first();
        
        if (!$chat) {
            $chat = Chat::create([
                'product_id' => $productId,
                'buyer_id' => Auth::id(),
                'seller_id' => $product->user_id,
            ]);
        }
        
        return redirect()->route('chat.show', $chat->id);
    }
    
    // Tampilkan chat
    public function show($id)
    {
        $chat = Chat::with(['product', 'messages.user'])
                    ->where(function($query) use ($id) {
                        $query->where('buyer_id', Auth::id())
                              ->orWhere('seller_id', Auth::id());
                    })
                    ->where('id', $id)
                    ->firstOrFail();
        
        // Mark messages as read
        Message::where('chat_id', $chat->id)
               ->where('user_id', '!=', Auth::id())
               ->update(['is_read' => true]);
        
        return view('chat.show', compact('chat'));
    }
    
    // Kirim pesan
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);
        
        $chat = Chat::where(function($query) use ($id) {
                        $query->where('buyer_id', Auth::id())
                              ->orWhere('seller_id', Auth::id());
                    })
                    ->where('id', $id)
                    ->firstOrFail();
        
        $message = Message::create([
            'chat_id' => $chat->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_read' => false
        ]);
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'user' => Auth::user()
        ]);
    }
    
    // Daftar chat user
    public function index()
    {
        $chats = Chat::where('buyer_id', Auth::id())
                     ->orWhere('seller_id', Auth::id())
                     ->with(['product', 'buyer', 'seller', 'lastMessage'])
                     ->latest()
                     ->get();
        
        return view('chat.index', compact('chats'));
    }
    
    // Ambil pesan baru (untuk refresh)
    public function getMessages($id)
    {
        $chat = Chat::where(function($query) use ($id) {
                        $query->where('buyer_id', Auth::id())
                              ->orWhere('seller_id', Auth::id());
                    })
                    ->where('id', $id)
                    ->firstOrFail();
        
        $messages = Message::where('chat_id', $chat->id)
                          ->with('user')
                          ->get();
        
        return response()->json($messages);
    }
}