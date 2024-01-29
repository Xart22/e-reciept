<?php

namespace Database\Seeders;

use App\Models\PenjualanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Penjualan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($x = 0; $x <= 10; $x++) {
            $no_faktur = 'S' . date('my') . '-' . str_pad($x + 1, 3, '0', STR_PAD_LEFT);
            $data[] = [
                "toko_id" => "3",
                "no_faktur" => $no_faktur,
                "tanggal" => "2024-01-" . $x + 1,
                "waktu" => "16:38",
                "nama_pelanggan" => $faker->name,
                "nama_perusahaan" => $faker->company,
                "telepon_pelanggan" => $faker->phoneNumber,
                "telepon_seluler" => $faker->phoneNumber,
                "email_pelanggan" => $faker->email,
                "alamat_pelanggan" => $faker->address,
                "item" => $faker->text,
                "keluhan" => $faker->text,
                "kelengkapan" => $faker->text,
                "created_by" => "1",
            ];
        }

        DB::table('penjualan')->insert($data);
    }
}
