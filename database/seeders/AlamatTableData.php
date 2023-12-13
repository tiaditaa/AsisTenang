<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlamatTableData extends DatabaseSeeder {
    public function run() {
        $faker = Faker::create();
        foreach (range(1, 1000) as $index) {
            DB::table('alamat')->insert([
                'nama_alamat' => $faker->word, // Menggunakan $faker tanpa tanda dolar berlebihan
                'id_penyewa' => $faker->numberBetween(1, 2),
                'id_provinsi' => $faker->numberBetween(1, 99),
                'id_kota' => $faker->numberBetween(1, 99),
                'id_kecamatan' => $faker->numberBetween(1, 99),
                'kode_pos' => $faker->numberBetween(1000, 9999),
                'alamat_lengkap' => $faker->address,
            ]);
        }
    }
}
