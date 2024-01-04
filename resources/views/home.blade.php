@extends('layouts.app')

@section('content')
<style>
    .ip{
        background-color: #EAE3DD;
        color:#EA7000;
    }

    .dn{
        color:#00793F;
        background-color:#C8F5E0;
    }
    .board{
        width:22rem;
        height: 9rem;
    }
    
    .cardouter{
        display:flex;
        align-items: stretch;
        justify-content: space-around;
    }
    .btn-search{
        background-color:#F28E31;
        color:white;
        border-radius:2rem;
    }

    .dashboard{
        border: solid 1px #EA7000;
        border-radius: 2rem;
    }

    .dashboard-search{
        border: solid 1px #EA7000;
        border-radius: 0.5rem;
    }
</style>
<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
</div>
<br>    
<div class="table-responsive">
            <table class="table table-borderless compact " id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    <tr>
                        <td>From</td>
                        <td><input type="date" class="form-control dashboard"></td>
                        <td>To</td>
                        <td><input type="date" class="form-control dashboard"></td>
                        <td><input type="text" class="form-control dashboard-search" id=""></td>
                        <td><a href="#" class="btn btn-search"><i class="fas fa-search"></i> Search</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
<div class="row">
    <div class="cardouter col-md-6">
        <div class="card board shadow mb-4"">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <h5 style="background-color: #EEF0F4; color:#466684; border-radius:5px;">Jumlah BPKB</h5>
                <h2 style="color:#0D4685"><b>22</b></h2>
            </div>
        </div>
    </div>
    <div class="cardouter col-md-6">
        <div class="card board shadow mb-4"">
            <div class="card-body">
            <div class="card-body text-center d-flex flex-column justify-content-center">
            <h5 style="background-color: #EEF0F4; color:#466684; border-radius:5px;">Jumlah Penyelesaian</h5>
                <h2 style="color:#03C0D0"><b>20</b></h2>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Jumlah BPKB</th>
                        <th>% Persentase</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>30/10/2023</td>
                        <td>23</td>
                        <td>80%</td>
                        <td class="ip">In Progress</td>
                    </tr>
                    <tr>
                        <td>28/10/2023</td>
                        <td>21</td>
                        <td>90%</td>
                        <td class="ip">In Progress</td>
                    </tr>
                    <tr>
                        <td>27/10/2023</td>
                        <td>24</td>
                        <td>100%</td>
                        <td class="dn">Done</td>
                    </tr>
                    <tr>
                        <td>26/10/2023</td>
                        <td>25</td>
                        <td>100%</td>
                        <td class="dn">Done</td>
                    </tr>
                    <tr>
                        <td>25/10/2023</td>
                        <td>28</td>
                        <td>100%</td>
                        <td class="dn">Done</td>
                    </tr>
                    <tr>
                        <td>24/10/2023</td>
                        <td>30</td>
                        <td>100%</td>
                        <td class="dn">Done</td>
                    </tr>
                    <tr>
                        <td>23/10/2023</td>
                        <td>26</td>
                        <td>100%</td>
                        <td class="dn">Done</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection
