<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_amount', 12, 0);
            $table->enum('payment_method', ['cod', 'transfer'])->default('transfer');
            $table->enum('payment_status', ['pending', 'waiting_confirmation', 'paid', 'cancelled'])->default('pending');
            $table->enum('order_status', ['pending', 'processed', 'shipped', 'delivered', 'completed', 'cancelled'])->default('pending');
            $table->string('proof_of_payment')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};