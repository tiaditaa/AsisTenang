<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index() {
        $kecList = Kecamatan::pluck('nama_kecamatan', 'id');
        return view('nama_tampilan', compact('kecList'));
    }
}
