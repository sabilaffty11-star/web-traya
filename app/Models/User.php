<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * ==================== RELASI PRODUK ====================
     */
    
    /**
     * Get the products for the user (barang yang dijual).
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    /**
     * Get only available products for the user.
     */
    public function availableProducts()
    {
        return $this->products()->where('status', 'tersedia');
    }
    
    /**
     * Get only sold products for the user.
     */
    public function soldProducts()
    {
        return $this->products()->where('status', 'terjual');
    }
    
    /**
     * Get total products count.
     */
    public function getTotalProductsCountAttribute()
    {
        return $this->products()->count();
    }
    
    /**
     * Get available products count.
     */
    public function getAvailableProductsCountAttribute()
    {
        return $this->products()->where('status', 'tersedia')->count();
    }
    
    /**
     * Get sold products count.
     */
    public function getSoldProductsCountAttribute()
    {
        return $this->products()->where('status', 'terjual')->count();
    }
    
    /**
     * Get total value of all products.
     */
    public function getTotalProductsValueAttribute()
    {
        return $this->products()->sum('harga');
    }
    
    /**
     * Get formatted total value.
     */
    public function getFormattedTotalValueAttribute()
    {
        return 'Rp ' . number_format($this->products()->sum('harga'), 0, ',', '.');
    }
    
    /**
     * ==================== RELASI CHAT ====================
     */
    
    /**
     * Get chats where user is the buyer.
     */
    public function chatsAsBuyer()
    {
        return $this->hasMany(Chat::class, 'buyer_id');
    }
    
    /**
     * Get chats where user is the seller.
     */
    public function chatsAsSeller()
    {
        return $this->hasMany(Chat::class, 'seller_id');
    }
    
    /**
     * Get all chats where user is either buyer or seller.
     */
    public function allChats()
    {
        return Chat::where('buyer_id', $this->id)
                   ->orWhere('seller_id', $this->id);
    }
    
    /**
     * Get messages sent by the user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    /**
     * Get unread messages count.
     */
    public function getUnreadMessagesCountAttribute()
    {
        // Get all chats where user is involved
        $chatIds = Chat::where('buyer_id', $this->id)
                       ->orWhere('seller_id', $this->id)
                       ->pluck('id');
        
        // Count unread messages
        return Message::whereIn('chat_id', $chatIds)
                      ->where('user_id', '!=', $this->id)
                      ->where('is_read', false)
                      ->count();
    }
    
    /**
     * Get recent chats for the user.
     */
    public function recentChats()
    {
        return Chat::where('buyer_id', $this->id)
                   ->orWhere('seller_id', $this->id)
                   ->with(['product', 'buyer', 'seller', 'lastMessage'])
                   ->latest()
                   ->get();
    }
}