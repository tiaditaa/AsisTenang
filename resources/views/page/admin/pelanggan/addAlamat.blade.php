@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Akun')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Alamat</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Alamat</li>
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
                        <h3 class="card-title">Informasi Data Alamat</h3>

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
                            <label for="inputNamaAlamat">Nama Alamat</label>
                            <input
                                type="text"
                                id="inputNamaAlamat"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan Nama Alamat"
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
                            <label for="inputProvinsi">Provinsi</label>
                            <select class="form-control" name="" id="">
                                <option value="">Provinsi</option>
                                <option value="">Provinsi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKota">Kota</label>
                            <select class="form-control" name="" id="">
                                <option value="">Kota</option>
                                <option value="">Kota</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKecamatan">Kecamatan</label>
                            <select class="form-control" name="" id="">
                                <option value="">Kecamatan</option>
                                <option value="">Kecamatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKodePos">Kode Pos</label>
                            <input type="text" class="form-control" id="inputKodePos" placeholder="Masukkan kode pos">
                        </div>
                        <div class="form-group">
                            <label for="inputAlamat">Alamat Lengkap</label>
                            <textarea name="inputAlamat" id="inputAlamat" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Password</h3>

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
                            <label for="password">Password</label>
                            <input
                                id="password"
                                type="password"
                                placeholder="Kata Sandi"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required="required"
                                autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Konfirmasi Password</label>
                            <input
                                placeholder="Ketik ulang kata sandi"
                                id="password-confirm"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                required="required"
                                autocomplete="new-password">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Tambah Akun" class="btn btn-success float-right">
            </div>
        </div>
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
