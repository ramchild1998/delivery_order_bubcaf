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
    <h1 class="h3 mb-2 text-gray-800">Data Office</h1>
    <a href="{{route('office.create')}}" type="button" class="btn btn-custom">+ Add Office</a>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Vendor</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Kode Pos</th>
                        <th>Telefon</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                @foreach ($offices as $office)
                    <tr>
                        <td><a class="btn btn-detail" href="{{route('office.edit', $office->id)}}">Detail</a></td>
                        <td>{{ $office->name }}</td>
                        <td>{{ $office->vendor->name}}</td>
                        <td>{{ $office->address }}</td>
                        <td>{{ $office->province->name }}</td>
                        <td>{{ $office->city->name}}</td>
                        <td>{{ $office->subdistrict->name}}</td>
                        <td>{{ $office->village->name}}</td>
                        <td>{{ $office->zip_code }}</td>
                        <td>{{ $office->pic_contact_number }}</td>
                        <td>@if ($office->is_active == 1)
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
    new DataTable('#dataTable', {
    scrollX: true
});
</script>
<!-- /.container-fluid -->
@endsection
