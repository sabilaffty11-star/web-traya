<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user dulu kalau belum ada
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Admin Traya',
                'email' => 'admin@traya.com',
                'password' => bcrypt('password123'),
            ]);
        }
        
        Product::create([
            'nama' => 'Hoodie Size L',
            'deskripsi' => 'Hoodie kondisi masih bagus',
            'harga' => 250000,
            'kategori' => 'Jacket',
            'user_id' => $user->id,
            'status' => 'tersedia'
        ]);
        
        Product::create([
            'nama' => 'Blouse',
            'deskripsi' => 'Size M, Pemakaian 4 Hari',
            'harga' => 350000,
            'kategori' => 'Atasan',
            'user_id' => $user->id,
            'status' => 'tersedia'
        ]);
        
        Product::create([
            'nama' => 'Lose Pants',
            'deskripsi' => 'Size 37',
            'harga' => 2000000,
            'kategori' => 'Celana',
            'user_id' => $user->id,
            'status' => 'tersedia'
        ]);
    }
}