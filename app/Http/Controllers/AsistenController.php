<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use Illuminate\Http\Request;
use DataTables;

class AsistenController extends Controller
{
    public function index()
    {
        return view('admin.asisten.index');
    }

    public function dataTable()
    {
        $asistens = Asisten::select(['id', 'nama_asisten', 'layanan', 'jenis_kelamin', 'ketersediaan']);

        return Asisten::of($asistens)
            ->addColumn('action', function ($asisten) {
                return '<a href="#" class="btn btn-sm btn-primary edit" data-id="' . $asisten->id . '">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger delete" data-id="' . $asisten->id . '">Delete</a>';
            })
            ->make(true);
    }

    public function addAsisten(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_asisten' => 'required',
                'layanan' => 'required',
                'jenis_kelamin' => 'required',
                'ketersediaan' => 'required',
            ]);

            Asisten::create($request->all());

            return response()->json(['success' => true]);
        }

        return view('admin.asisten.addAsisten');
    }

    public function ubahAsisten(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $this->validate($request, [
                'nama_asisten' => 'required',
                'layanan' => 'required',
                'jenis_kelamin' => 'required',
                'ketersediaan' => 'required',
            ]);

            $asisten = Asisten::findOrFail($id);
            $asisten->update($request->all());

            return response()->json(['success' => true]);
        }

        $asisten = Asisten::findOrFail($id);

        return view('admin.asisten.ubahAsisten', compact('asisten'));
    }

    public function deleteAsisten($id)
    {
        $asisten = Asisten::findOrFail($id);
        $asisten->delete();

        return response()->json(['success' => true]);
    }
}