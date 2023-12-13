<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\DatabaseSeeder;

class KecTableData extends DatabaseSeeder {
    public function run() {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('kecamatan')->insert([
                'nama_kec' => $faker->word,
                'id_kota' => $faker->numberBetween(1, 100)
            ]);
        }
    }
}
