@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Asisten')

@section('content')
    <h1>Asisten List</h1>
    <table id="asisten-table" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Asisten</th>
                <th>Layanan</th>
                <th>Jenis Kelamin</th>
                <th>Ketersediaan</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#asisten-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('asisten.dataTable') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama_asisten', name: 'nama_asisten' },
                    { data: 'layanan', name: 'layanan' },
                    { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                    { data: 'ketersediaan', name: 'ketersediaan' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush