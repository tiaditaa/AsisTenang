<!DOCTYPE html>
<html>
<head>
	<title>Export Laporan Excel Pada Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<center>
			<h4>Export Laporan Excel Pada Laravel</h4>
			<h5><a target="_blank" href="https://www.malasngoding.com/">www.malasngoding.com</a></h5>
		</center>

		<a href="export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>

		<table class='table table-bordered'>
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
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($show as $s)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$s->id}}</td>
					<td>{{$s->id_penyewa}}</td>
					<td>{{$s->id_provinsi}}</td>
                    <td>{{$s->id_kota}}</td>
                    <td>{{$s->id_kecamatan}}</td>
                    <td>{{$s->nama_alamat}}</td>
                    <td>{{$s->kode_pos}}</td>
                    <td>{{$s->alamat_lengkap}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</body>
</html>
