<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama' => 'Kaos Polos Biru',
                'deskripsi' => 'Kaos polos warna biru berbahan katun combed 30s, nyaman dipakai sehari-hari.',
                'harga' => 75000,
                'kategori_id' => 1,
                'gambar' => 'https://via.placeholder.com/300x200?text=Kaos+Biru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kaos Polos Hitam',
                'deskripsi' => 'Kaos polos warna hitam dengan bahan premium yang cocok untuk segala acara.',
                'harga' => 80000,
                'kategori_id' => 1,
                'gambar' => 'https://via.placeholder.com/300x200?text=Kaos+Hitam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Hoodie Abu-abu',
                'deskripsi' => 'Hoodie hangat warna abu-abu cocok untuk musim hujan dan santai.',
                'harga' => 150000,
                'kategori_id' => 1,
                'gambar' => 'https://via.placeholder.com/300x200?text=Hoodie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kemeja Kotak-kotak',
                'deskripsi' => 'Kemeja kasual dengan motif kotak-kotak, cocok untuk gaya semi-formal.',
                'harga' => 130000,
                'kategori_id' => 1,
                'gambar' => 'https://via.placeholder.com/300x200?text=Kemeja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jaket Denim',
                'deskripsi' => 'Jaket berbahan denim berkualitas tinggi, memberikan kesan stylish.',
                'harga' => 200000,
                'kategori_id' => 1,
                'gambar' => 'https://via.placeholder.com/300x200?text=Jaket+Denim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}