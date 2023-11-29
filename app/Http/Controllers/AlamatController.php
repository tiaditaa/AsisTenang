<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\Alamat;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        if ($request->isMethod('post')) {
            Alamat::create([
                'id_penyewa' => $userId,
                'nama_alamat' => $request->nama_alamat,
                'id_provinsi' => $request->id_provinsi,
                'id_kota' => $request->id_kota,
                'id_kecamatan' => $request->id_kecamatan,
                'kode_pos' => 5,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]);
            return redirect()->route('alamat.add')->with('status', 'Data telah tersimpan di database');
        }
        $provinsiList = Provinsi::all();
        $kotaList = Kota::all();
        $kecList = Kecamatan::all();
        return view('page.admin.pelanggan.addAlamat', compact('provinsiList', 'kotaList', 'kecList'));
    }

    public function ubahAkun($id, Request $request)
    {
        $alamat = Alamat::findOrFail($id);
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'id_provinsi' => 'required',
                'id_kota' => 'required',
                'id_kecamatan' => 'required',
                'nama_alamat' => 'required|string',
                'kode_pos' => 'required'
            ]);

            $alamat->update([
                'id_provinsi' => $request->id_provinsi,
                'id_kota' => $request->id_kota,
                'id_kecamatan' => $request->id_kecamatan,
                'nama_alamat' => $request->nama_alamat,
                'kode_pos' => $request->kode_pos
            ]);
            return redirect()->route('akun.edit',['id' => $alamat->id ])->with('status', 'Data telah tersimpan di database');
        }
        return view('page.admin.akun.ubahAkun', [
            'alamat' => $alamat
        ]);
    }

}
