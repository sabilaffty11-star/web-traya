<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_number', 'buyer_id', 'seller_id', 'total_amount',
        'payment_method', 'payment_status', 'order_status',
        'proof_of_payment', 'shipping_address', 'phone_number', 'notes', 'paid_at'
    ];
    
    protected $casts = [
        'paid_at' => 'datetime'
    ];
    
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Generate order number
    public static function generateOrderNumber()
    {
        return 'TR-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}