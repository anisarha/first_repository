<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'nama_produk' => 'Sepatu Olahraga',
            'kategori' => 'Olahraga',
            'harga_jual' => 250000.00,
            'harga_beli' => 200000.00,
            'stok' => 100,
            'status' => 'ACTIVE',
            'created_by' => 'Admin',
            'created_date' => now(),
            'updated_by' => null,
            'update_date' => null,
            'void_date' => null,
        ]);
    }
}
