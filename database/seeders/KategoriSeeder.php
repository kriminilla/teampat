<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'id' => 1,
                'nama' => 'Pakaian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
