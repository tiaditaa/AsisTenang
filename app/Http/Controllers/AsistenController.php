<?php

namespace App\Http\Controllers;

use app\Models\Asisten;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AsistenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'nama_alamat' => 'required',
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kode_pos' => 'required',
                'alamat_lengkap' => 'required',
            ]);

            Asisten::create([
                'nama_alamat' => $request->nama_alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kode_pos' => $request->kode_pos,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]);
            return redirect()->route('akun.add')->with('status', 'Data telah tersimpan di database');
        }
        return view('page.admin.pelanggan.addAlamat');
    }

    public function getData()
    {
        $alamat = Asisten::all();

        $dataAlamat = $alamat->map(function ($alamat) {
            return [
                'id_alamat' => $alamat->id,
                'nama_alamat' => $alamat->nama_alamat,
                'provinsi' => $alamat->provinsi,
                'kota' => $alamat->kota,
                'kecamatan' => $alamat->kecamatan,
                'kode_pos' => $alamat->kode_pos,
                'alamat_lengkap' => $alamat->alamat_lengkap,
            ];
        });

        return response()->json($dataAlamat, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $alamat = Asisten::findOrFail($id);
            return response()->json($alamat);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Alamat tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alamat = Asisten::find($id);

        if (!$alamat) {
            return response()->json(['message' => 'Data alamat tidak ditemukan'] . 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
            'alamat_lengkap' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $alamat->nama_alamat = $request->input('nama_alamat');
        $alamat->provinsi = $request->input('provinsi');
        $alamat->kota = $request->input('kota');
        $alamat->kecamatan = $request->input('kecamatan');
        $alamat->kode_pos = $request->input('kode_pos');
        $alamat->alamat_lengkap = $request->input('alamat_lengkap');
        $alamat->save();

        return response()->json(['message' => 'Data alamat berhasil diperbarui'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $alamat = Asisten::find($id);

        if (!$alamat) {
            return response()->json(['message' => 'Data roti tidak ditemukan'], 404);
        }

        $alamat->delete();

        return response()->json(['message' => 'Data roti berhasil dihapus'], 200);
    }
}
