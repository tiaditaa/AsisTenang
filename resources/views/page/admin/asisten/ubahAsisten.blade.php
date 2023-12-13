@extends('layouts.base_admin.base_dashboard') @section('judul', 'Ubah Asisten')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Asisten</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Asisten</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    @if(session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('status') }}
    </div>
    @endif
    <form method="post" enctype="multipart/form-data">
        @csrf
        {{-- @method('put') --}}
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Data Asisten</h3>

                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputNamaAsisten">Nama Asisten</label>
                            <input
                                type="text"
                                id="inputNamaAsisten"
                                name="nama_asisten"
                                class="form-control @error('nama_asisten') is-invalid @enderror"
                                placeholder="Masukkan Nama Asisten"
                                value="{{ old('nama_asisten', $asisten->nama_asisten) }}"
                                required="required"
                            >
                            @error('nama_asisten')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputLayanan">Layanan</label>
                            <select class="form-control" name="layanan">
                                <option value="Pembersihan" {{ $asisten->layanan === 'Pembersihan' ? 'selected' : '' }}>Pembersihan</option>
                                <option value="Perawatan" {{ $asisten->layanan === 'Perawatan' ? 'selected' : '' }}>Perawatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputJenisKelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="Laki-laki" {{ $asisten->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $asisten->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKetersediaan">Ketersediaan</label>
                            <select class="form-control" name="ketersediaan">
                                <option value="1" {{ $asisten->ketersediaan === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="0" {{ $asisten->ketersediaan === 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update Asisten</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@endsection