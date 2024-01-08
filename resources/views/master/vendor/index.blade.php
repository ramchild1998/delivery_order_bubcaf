@extends('layouts.app')

@section('content')
<style>
    .btn-detail{
        border: solid 2px #0083FD;
        color:#0083FD;
        font-weight:600;
        border-radius: 2rem;
    }

    .btn-detail:hover{
        background-color: #0083FD;
        color:white;
        border-radius: 2rem;
    }
</style>
<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Data Vendor</h1>
    <a href="{{route('vendor.create')}}" type="button" class="btn btn-custom">+ Add Vendor</a>
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
                        <th>Name</th>
                        <th>PIC Name</th>
                        <th>PIC Contact Number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($vendors as $vendor)
                    <tr>
                        <td><a class="btn btn-detail" href="{{route('vendor.edit', $vendor->id)}}">Detail</a></td>
                        <td>{{ $vendor->name }}</td>
                        <td>{{ $vendor->pic_name }}</td>
                        <td>{{ $vendor->pic_contact_num }}</td>
                        <td>@if ($vendor->is_active == 1)
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
