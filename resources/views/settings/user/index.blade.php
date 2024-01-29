@extends('layouts.app')

@section('content')
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
        border-raius:2rem;
    }

</style>

<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Data Users</h1>
    <a href="{{route('users.create')}}" type="button" class="btn btn-custom">+ Add Users</a>
</div>
<div class="">


<br>    
<!-- @if(session('success'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
</div>
    {{ session('success') }}
  </div>
</div>
@endif -->
<!-- DataTales Example -->
<a href="{{route('user.export')}}" class="ml-2 btn btn-custom shadow-none"><span>Export</span></a>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Vendor</th>
                        <th>Office</th>
                        <th>Contac No.</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td></td>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Vendor</th>
                        <th>Office</th>
                        <th>Contac No.</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a class="btn btn-detail" href="{{route('users.edit', $user->id)}}">Detail</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->vendor_name}}</td>
                        <td>{{ $user->office_name }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>{{ $user->role_name }}</td>
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

<script>
    $(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>
<!-- /.container-fluid -->
@endsection
