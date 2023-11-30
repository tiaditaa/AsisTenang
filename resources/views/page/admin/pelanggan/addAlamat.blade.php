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
                            <label for="nama_alamat">Nama Alamat</label>
                            <input
                                type="text"
                                id="nama_alamat"
                                name="nama_alamat"
                                class="form-control @error('nama_alamat') is-invalid @enderror"
                                placeholder="Masukkan Nama Alamat"
                                required="required"
                                autocomplete="off">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputProvinsi">Provinsi</label>
                            <select class="form-control" name="id_provinsi" id="id_provinsi">
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @foreach ($provinsiList as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKota">Kota</label>
                            <select class="form-control" name="id_kota" id="id_kota">
                                <option value="" disabled selected>Pilih Kota</option>
                                @foreach ($kotaList as $kota)
                                    <option value="{{ $kota->id }}">{{ $kota->nama_kota }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKecamatan">Kecamatan</label>
                            <select class="form-control" name="id_kecamatan" id="id_kecamatan">
                                <option value="" disabled selected>Pilih Kecamatan</option>
                                @foreach ($kecList as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kec }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" placeholder="Masukkan kode pos">
                        </div>
                        <div class="form-group">
                            <label for="alamat_lengkap">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
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
