@extends('layouts.app')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Data Device</h1>
    <a href="{{route('device.create')}}" type="button" class="btn btn-custom">+ Add Device</a>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Kurir ID</th>
                        <th>Kurir</th>
                        <th>IMEI / Device ID</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($device as $dev)
                    <tr>
                        <td><a class="btn btn-detail" href="{{route('device.edit', $dev->id)}}">Detail</a></td>
                        <td>{{ $dev->kurir->id }}</td>
                        <td>{{ $dev->kurir->name }}</td>
                        <td>{{ $dev->device_id }}</td>
                        <td>{{ $dev->merk }}</td>
                        <td>{{ $dev->type }}</td>
                        <td>@if ($dev->is_active == 1)
                                active
                            @else
                                inactive
                            @endif
                        </td>
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
