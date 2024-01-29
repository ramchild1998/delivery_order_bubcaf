@extends('layouts.app')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Pick Up Report</h1>
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
                @foreach ($pickup as $pu)
                    <tr>
                        <td>{{ $pu->date_visit }}</td>
                        <td>{{ $pu->no_consumen }}</td>
                        <td>{{ $pu->name_consumen }}</td>
                        <td>{{ $pu->address }}</td>
                        <td>{{ $pu->zip_code }}</td>
                        <td>{{ $pu->no_hp }}</td>
                        <td>{{ $pu->kurir_id }}</td>
                        <td>{{ $pu->kurir_name}}</td>
                        <td>{{ $pu->time_start}}</td>
                        <td>{{ $pu->time_end}}</td>
                        <td>{{ $pu->status }}</td>
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
