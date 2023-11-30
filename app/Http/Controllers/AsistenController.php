<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use Illuminate\Http\Request;
use DataTables;

class AsistenController extends Controller
{
    public function index()
    {
        return view('page.admin.asisten.index');
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
        }

        return view('page.admin.asisten.addAsisten');
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
        }

        $asisten = Asisten::findOrFail($id);

        return view('page.admin.asisten.ubahAsisten', compact('asisten'));
    }

    public function deleteAsisten($id)
    {
        $asisten = Asisten::findOrFail($id);
        $asisten->delete();
    }
}
