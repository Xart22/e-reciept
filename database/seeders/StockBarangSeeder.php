<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // generate 10 data dummy menggunakan faker
        $faker = \Faker\Factory::create('id_ID');
        for ($x = 0; $x <= 100; $x++) {
            $data[] = [
                'kode_barang' => $faker->unique()->ean8(),
                'nama_barang' => $faker->name,
                'stok_barang' => $faker->numberBetween(1, 100),
                'satuan_barang' => $faker->randomElement(['pcs', 'box', 'lusin']),
                'harga_barang' => $faker->numberBetween(1000, 100000),
                'gambar_barang' => $faker->imageUrl(640, 480),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // insert data dummy ke database
        DB::table('stok_barang')->insert($data);
    }
}
