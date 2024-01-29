@extends('layouts.app')

@section('content')
<style>
    /* Your styles here */
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="page-heading">
        <h1 class="h3 mb-2 text-gray-800">Edit Parameter</h1>
        <a href="{{ route('parameter.index') }}" class="btn btn-custom">Back</a>
    </div>
    <br>    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('parameter.update', $parameter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <table class="table table-borderless" id="" cellspacing="0">
                    <tbody>
                        <tr style="">
                            <td><b>{{$parameter->param_name}}</b></td>
                            <td><b>:</b></td>
                            <td><input id="nilai" type="text" class="form-control" name="nilai" value="{{ $nilai_aktif }}"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="buttons">
                    <a href="{{ route('parameter.index') }}" class="btn btn-primary cnclbtn">Cancel</a>
                    <button type="submit" class="btn btn-primary svbtn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="" cellspacing="0">
                <thead>
                    <tr>
                        <th class="table-active">Updated At</th>
                        <th class="table-active">Updated By</th>
                        <th class="table-active">Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($param_history as $param)
                        <tr>
                            <td>{{ $param->created_at }}</td>
                            <td>{{ $param->user_name }}</td>
                            <td>{{ $param->nilai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // Your script here
</script>

@endsection