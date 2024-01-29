@extends('layouts.app')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Delivery Realization Report</h1>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>ID Konsumen</th>
                        <th>Nama Konsumen</th>
                        <th>Alamat</th>
                        <th>Kode Pos</th>
                        <th>No Telp</th>
                        <th>ID Kurir</th>
                        <th>Nama Kurir</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($delivered as $dr)
                    <tr>
                        <td>{{ $dr->date_visit }}</td>
                        <td>{{ $dr->no_consumen }}</td>
                        <td>{{ $dr->name_consumen }}</td>
                        <td>{{ $dr->address }}</td>
                        <td>{{ $dr->zip_code }}</td>
                        <td>{{ $dr->no_hp }}</td>
                        <td>{{ $dr->kurir_id }}</td>
                        <td>{{ $dr->kurir_name}}</td>
                        <td>{{ $dr->time_start}}</td>
                        <td>{{ $dr->time_end}}</td>
                        <td>{{ $dr->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection
