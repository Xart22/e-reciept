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
        for ($x = 0; $x <= 100; $x++) {
            $no = PenjualanModel::where('tanggal', 'like', '%' . date('Y-m') . '%')->count();
            $no_faktur = 'S' . date('my') . '-' . str_pad($no + 1, 3, '0', STR_PAD_LEFT);
            DB::table('penjualan')->insert(
                [
                    "toko_id" => "3",
                    "no_faktur" => $no_faktur,
                    "tanggal" => date('Y-m-d'),
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
                    'sales_id' => '1',
                ]
            );
        }
    }
}
