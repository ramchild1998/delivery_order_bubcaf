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
    <h1 class="h3 mb-2 text-gray-800">Data Users</h1>
    <a href="{{route('users.create')}}" type="button" class="btn btn-custom">+ Add Users</a>
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
                        <th>Username</th>
                        <th>Access Type</th>
                        <th>Contac No.</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a class="btn btn-detail" href="{{route('users.edit', $user->id)}}">Detail</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->access_type }}</td>
                        <td>{{ $user->contact_no }}</td>
                        <td>{{ $user->role }}</td>
                        <td>@if ($user->is_active == 1)
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
