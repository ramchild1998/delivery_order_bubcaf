@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="page-heading">
            <h1 class="h3 mb-2 text-gray-800">Pick Up</h1>
        </div>
        <br>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                <form id="searchForm" action="{{ route('pickup.index') }}" method="GET">
                @csrf
                    <table class="table table-borderless compact " id="dataTable2" width="100%" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>From</td>
                            <td><input type="date" id="dateFrom" name="dateFrom" class="form-control dashboard"></td>
                            <td>To</td>
                            <td><input type="date" id="dateTo" name="dateTo" class="form-control dashboard"></td>
                            <td colspan=1><a href="#" class="btn btn-search"><i class="fas fa-search"></i> Search</a></td>
                        </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>

        @if(session('error'))
            <script>
                swal("Error", "{{ session('error') }}", "error");
            </script>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                <form action="{{ route('update.status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selectedIds[]" id="selectedIds">
                    <button type="submit" id="approveButton" class="btn btn-approve mb-3">Approve</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0"  id="dataTable">
                            <thead>
                            <tr>
                                <th class="text-center info"><input type="checkbox" name="selectAll"
                                                                    class="selectAll" id="flexCheckIndeterminate"></th>
                                <th>Action</th>
                                <th>Tanggal</th>
                                <th>ID Konsumen</th>
                                <th>Nama Konsumen</th>
                                <th>Alamat</th>
                                <th>Kode Pos</th>
                                <th>ID Kurir</th>
                                <th>Nama Kurir</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan=3></td>
                                    <th>ID Konsumen</th>
                                    <th>Nama Konsumen</th>
                                    <th>Alamat</th>
                                    <th>Kode Pos</th>
                                    <th>ID Kurir</th>
                                    <th>Nama Kurir</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($pickup as $pu)
                                <tr>
                                    <td class="text-center"><input id="{{ $pu->id }}" value="{{ $pu->id }}"
                                                                   type="checkbox" name="selectedRows[]" class="checkboxes"></td>
                                    <td><a class="btn btn-detail" href="{{ route('pickup.edit', $pu->id) }}">Detail</a></td>
                                    <td>{{ $pu->date_visit }}</td>
                                    <td>{{ $pu->no_consumen }}</td>
                                    <td>{{ $pu->name_consumen }}</td>
                                    <td>{{ $pu->address }}</td>
                                    <td>{{ $pu->zip_code }}</td>
                                    <td>{{ $pu->kurir->id ?? '' }}</td>
                                    <td>{{ $pu->kurir->name ?? '' }}</td>
                                    <td>{{ $pu->status}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <script>
        const checkbox = document.getElementById("flexCheckIndeterminate");
        checkbox.addEventListener('input', evt => {
            const checked = evt.target.checked;
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });
        });

        document.getElementById('approveButton').addEventListener('click', function () {
            let selectedIds = [];
            const checkboxes = document.querySelectorAll('.checkboxes:checked');
            checkboxes.forEach(function (checkbox) {
                selectedIds.push(checkbox.value);
            });

            document.getElementById('selectedIds').value = selectedIds.join(',');
        });
    </script>
<script>
    // Add an event listener to the search button
    document.querySelector('.btn-search').addEventListener('click', function() {
        // Get the values of dateFrom and dateTo
        var dateFrom = document.getElementById('dateFrom').value;
        var dateTo = document.getElementById('dateTo').value;

        // Modify the URL parameters and submit the form
        var url = new URL(window.location.href);
        url.searchParams.set('dateFrom', dateFrom);
        url.searchParams.set('dateTo', dateTo);
        window.location.href = url.href;
    });
</script>

@endsection