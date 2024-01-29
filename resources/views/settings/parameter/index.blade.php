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
    <h1 class="h3 mb-2 text-gray-800">Parameter List</h1>
    <!-- <a href="{{route('users.create')}}" type="button" class="btn btn-custom">+ Add Users</a> -->
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                </thead>
                <tbody>
                @foreach ($parameter as $param)
                    <tr>
                        <td><a class="btn btn-detail" href="{{route('parameter.edit', $param->id)}}">Detail</a></td>
                        <td>{{ $param->param_name }}</td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection