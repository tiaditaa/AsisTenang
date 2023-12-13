<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinsiTableData::class,
            KotaTableData::class,
            KecTableData::class,
            AlamatTableData::class

        ]);
    }

    // public function jalan()
    // {
    //     $this->call([
    //         ProvinsiTableData::class
    //     ]);
    // }

//     public function jalans()
//     {
//         $this->call([
//             KotaTableData::class
//         ]);
//     }

//     public function jalanss()
//     {
//         $this->call([
//             KecTableData::class
//         ]);
//     }
}
