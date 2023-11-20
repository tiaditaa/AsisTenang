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
    public function tambahAsisten(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'nama_asisten' => 'required',
                'layanan' => 'required',
                'jenis_kelamin' => 'required',
                'ketersediaan' => 'required',
            ]);

            Asisten::create([
                'nama_asisten' => $request->nama_asisten,
                'layanan' => $request->layanan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'ketersediaan' => $request->ketersediaan,
            ]);
            return redirect()->route('asisten.add')->with('status', 'Data telah tersimpan di database');
        }
        return view('page.admin.akun.addAsisten');
    }

    public function getData()
    {
        $asisten = Asisten::all();

        $dataAsisten = $asisten->map(function ($asisten) {
            return [
                'id_asisten' => $asisten->id,
                'nama_asisten' => $asisten->nama_asisten,
                'layanan' => $asisten->layanan,
                'jenis_kelamin' => $asisten->jenis_kelamin,
                'ketersediaan' => $asisten->ketersediaan,
            ];
        });

        return response()->json($dataAsisten, 200);
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
            return response()->json(['message' => 'Asisten tidak ditemukan'], 404);
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
        $asisten = Asisten::find($id);

        if (!$asisten) {
            return response()->json(['message' => 'Data alamat tidak ditemukan'] . 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_asisten' => 'required',
            'layanan' => 'required',
            'jenis_kelamin' => 'required',
            'ketersediaan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $asisten->nama_asisten = $request->input('nama_asisten');
        $asisten->layanan = $request->input('layanan');
        $asisten->jenis_kelamin = $request->input('jenis_kelamin');
        $asisten->ketersediaan = $request->input('ketersediaan');
        $asisten->save();

        return response()->json(['message' => 'Data asisten berhasil diperbarui'], 200);
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
            return response()->json(['message' => 'Data asisten tidak ditemukan'], 404);
        }

        $alamat->delete();

        return response()->json(['message' => 'Data asisten berhasil dihapus'], 200);
    }
}
