<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;
    
    public function definition(): array
    {
        // Cari user yang sudah ada, atau buat baru
        $user = User::inRandomOrder()->first();
        
        $kategori = ['Elektronik', 'Fashion', 'Furniture', 'Buku', 'Olahraga', 'Lainnya'];
        $status = ['tersedia', 'tersedia', 'tersedia', 'terjual'];
        
        return [
            'nama' => $this->faker->words(3, true),
            'deskripsi' => $this->faker->paragraph(2),
            'harga' => $this->faker->numberBetween(50000, 5000000),
            'kategori' => $this->faker->randomElement($kategori),
            'gambar' => null,
            'user_id' => $user ? $user->id : User::factory()->create()->id,
            'status' => $this->faker->randomElement($status),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}