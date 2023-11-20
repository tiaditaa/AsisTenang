@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Asisten')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Asisten</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Asisten</li>
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
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan Nama Asisten"
                                value="{{ old('name') }}"
                                required="required"
                                autocomplete="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputLayanan">Layanan</label>
                            <select class="form-control" name="Layanan" id="">
                                <option value="">Pembersihan</option>
                                <option value="">Perawatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputJenisKelamin">Jenis Kelamin</label>
                            <select class="form-control" name="" id="">
                                <option value="">Laki-laki</option>
                                <option value="">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKetersediaan">Ketersediaan</label>
                            <select class="form-control" name="" id="">
                                <option value="">Tersedia</option>
                                <option value="">Tidak Tersedia</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="col-4" >
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Tambah Akun" class="btn btn-success float-right">
                    </div>
                    <br>
                </div>
            </div>
                <!-- /.card -->
    </form>
</section>
<!-- /.content -->

@endsection @section('script_footer')
<script>
    inputFoto.onchange = evt => {
        const [file] = inputFoto.files
        if (file) {
            prevImg.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
