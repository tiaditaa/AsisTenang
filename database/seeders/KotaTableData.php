<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\DatabaseSeeder;

class KotaTableData extends DatabaseSeeder {
    public function run() {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('kota')->insert([
                'nama_kota' => $faker->word,
                'id_provinsi' =>$faker->numberBetween(1, 100)
            ]);
        }
    }
}
