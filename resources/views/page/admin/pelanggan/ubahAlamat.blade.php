@extends('layouts.base_admin.base_dashboard') @section('judul', 'Ubah Alamat')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ubah Alamat</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Ubah Alamat</li>
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
                            <label for="inputName">Nama Alamat</label>
                            <input
                                type="text"
                                id="inputName"
                                name="nama_alamat"
                                class="form-control @error('nama_alamat') is-invalid @enderror"
                                placeholder="Masukkan Nama Alamat"
                                value="{{ $alamat->nama_alamat }}"
                                required="required"
                                autocomplete="name">
                            @error('nama_alamat')
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
                                <option value="{{ $provinsi->id }}" {{ $alamat->id_provinsi == $provinsi->id ? 'selected' : '' }}>
                                    {{ $provinsi->nama_provinsi }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKota">Kota</label>
                            <select class="form-control" name="id_kota" id="id_kota">
                                <option value="" disabled selected>Pilih Kota</option>
                                @foreach ($kotaList as $kota)
                                    <option value="{{ $kota->id }}" {{ $alamat->id_kota == $kota->id ? 'selected' : '' }}>
                                        {{ $kota->nama_kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputKecamatan">Kecamatan</label>
                            <select class="form-control" name="id_kecamatan" id="id_kecamatan">
                                <option value="" disabled selected>Pilih Kecamatan</option>
                                @foreach ($kecList as $kecamatan)
                                    <option value="{{ $kecamatan->id }}" {{ $alamat->id_kecamatan == $kecamatan->id ? 'selected' : '' }}>
                                        {{ $kecamatan->nama_kec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Kode Pos</label>
                            <input
                                type="text"
                                id="kode_pos"
                                name="kode_pos"
                                class="form-control @error('kode_pos') is-invalid @enderror"
                                placeholder="Masukkan Kode Pos"
                                value="{{ $alamat->kode_pos }}"
                                required="required"
                                autocomplete="name">
                            @error('kode_pos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputName">Nama Alamat</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control" @error('alamat_lengkap') is-invalid @enderror" required="required">{{ $alamat->alamat_lengkap }}</textarea>
                            @error('nama_alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Ubah Alamat" class="btn btn-success float-right">
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
