@extends('layouts.base_admin.base_dashboard')

@section('judul', 'Pilihan Asisten')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pilihan Asisten</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Pilihan Asisten</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @foreach($dataAsisten as $asisten)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $asisten->nama_asisten }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>Layanan: {{ $asisten->layanan }}</p>
                            <p>Jenis Kelamin: {{ $asisten->jenis_kelamin }}</p>
                            <p>Ketersediaan: {{ $asisten->ketersediaan }}</p>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route('asisten.edit', $asisten->id) }}" class="btn btn-primary">Pilih Asisten</a>
                            {{-- <button class="btn btn-danger hapusAsisten" data-id="{{ $asisten->id }}">Hapus</button> --}}
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            @endforeach
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('script_footer')
    <script>
        $(document).ready(function () {
            // hapus data
            $('.hapusAsisten').on('click', function () {
                var id = $(this).data("id");

                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Kamu tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url("dashboard/admin/asisten/hapus") }}/' + id,
                            type: 'delete',
                            data: {
                                "id": id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire('Terhapus!', response.msg, 'success');
                                location.reload();
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
