<?php

namespace App\Exports;

use App\Models\Alamat;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlamatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alamat::all();
    }
}
