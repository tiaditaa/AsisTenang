@extends('layouts.base_admin.base_dashboard')@section('judul', 'List Alamat')
@section('script_head')
<link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Alamat</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Alamat</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                    title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="remove"
                    title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0" style="margin: 20px">
            <table
                id="previewAlamat"
                class="table table-striped table-bordered display"
                style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Penyewa</th>
                        <th>ID Provinsi</th>
                        <th>ID Kota</th>
                        <th>ID Kecamatan</th>
                        <th>Nama Alamat</th>
                        <th>Kode Pos</th>
                        <th>Alamat Lengkap</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection @section('script_footer')
<script
    type="text/javascript"
    src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script
    type="text/javascript"
    src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
                $('#previewAlamat').DataTable({
                    "serverSide": true,
                    "processing": true,
                    "ajax": {
                        "url": "{{ route('alamat.getAlamat') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": {
                            _token: "{{csrf_token()}}"
                        }
                    },
                    "columns": [
                        {
                            "data": "id"
                        }, {
                            "data": "id_penyewa"
                        }, {
                            "data": "id_provinsi"
                        }, {
                            "data": "id_kota"
                        }, {
                            "data": "id_kecamatan"
                        }, {
                            "data": "nama_alamat"
                        }, {
                            "data": "kode_pos"
                        }, {
                            "data": "alamat_lengkap"
                        }, {
                            "data": "id",
                            "name": "id",
                            render: function (data, type, full, meta) {
                            var routeUrl = '{{ route("alamat.edit", ":id") }}';
                            routeUrl = routeUrl.replace(':id', data);
                            return '<a href="' + routeUrl + '" class="ubahAlamat" data-id="' + data + '"><i class="fas fa-edit fa-lg"></i></a> ' +
                                   '<a href="#" class="hapusAlamat" data-id="' + data + '"><i class="fas fa-trash fa-lg text-danger"></i></a>';
                            }
                        }

                    ],
                    "language": {
                        "decimal": "",
                        "emptyTable": "Tak ada data yang tersedia pada tabel ini",
                        "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                        "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                        "infoFiltered": "(difilter dari _MAX_ total entri)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Tampilkan _MENU_ entri",
                        "loadingRecords": "Loading...",
                        "processing": "Sedang Mengambil Data...",
                        "search": "Pencarian:",
                        "zeroRecords": "Tidak ada data yang cocok ditemukan",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        },
                        "aria": {
                            "sortAscending": ": aktifkan untuk mengurutkan kolom ascending",
                            "sortDescending": ": aktifkan untuk mengurutkan kolom descending"
                        }
                    }

                });

                // $('#tbl_list').on('click', '.ubahAlamat', function (e) {
                //     e.preventDefault();
                //     var id = $(this).data('id');
                //     window.location.href = '{{ url("dashboard/admin/alamat/ubah") }}/' + id;
                // });

                // hapus data
                $('#previewAlamat').on('click', '.hapusAlamat', function () {
                    var id = $(this).data("id");
                    var url = $(this).data("url");

                    Swal
                        .fire({
                            title: 'Apa kamu yakin?',
                            text: "Kamu tidak akan dapat mengembalikan ini!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ url("dashboard/admin/alamat/hapus") }}/' + id,
                                    type: 'DELETE',
                                    data: {
                                        "id": id,
                                        "_token": "{{csrf_token()}}"
                                    },
                                    success: function (response) {
                                        Swal.fire('Terhapus!', response.msg, 'success');
                                        $('#previewAlamat').DataTable().ajax.reload();
                                    }
                                });
                            }
                        })
                });
        });
</script>
@endsection
