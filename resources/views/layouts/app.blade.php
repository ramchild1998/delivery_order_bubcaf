<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>P2DS</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('sbadmin')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('sbadmin')}}/css/sb-admin-2.min.css" rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />

    <!-- DataTables -->
    <link href='https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css' rel='stylesheet' />
    <!-- Custom styles for this page -->
    <link href="{{asset('sbadmin')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>
<style>
        .sidebar-brand .logo-ats{
        max-width:40%;
        height:auto;
        margin:2rem;
    }

    .sidebar-brand button{
        margin-top:1rem;
    }
</style>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<style>

    .btn-approve{
        background-color:#0D3C71;
        color:white;
        font-weight:bold;
        border-radius:2rem;
    }
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
        border: solid 1px #EA7000;
        background-color:#EA7000 !important;
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
    @include('sweetalert::alert')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
                <div class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-text mx-3">P2DS</div>
                    <!-- <img class="logo-ats" src="{{ asset('images/logoats-removebg-preview.png') }}" alt="description of myimage">                     -->
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{'/home'}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Interface
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
                    aria-expanded="true" aria-controls="collapseMaster">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Master</span>
                </a>
                <div id="collapseMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded">
                        <a class="text-white collapse-item" href="{{route('vendor.index')}}">Vendor</a>
                        <a class="text-white collapse-item" href="{{route('office.index')}}">Office</a>
                        <a class="text-white collapse-item" href="{{route('kurir.index')}}">Kurir</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJo"
                    aria-expanded="true" aria-controls="collapseJo">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Job Order</span>
                </a>
                <div id="collapseJo" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded">
                        <a class="text-white collapse-item" href="{{route('pickup.index')}}">Pick Up</a>
                        <a class="text-white collapse-item" href="{{route('tracking.index')}}">Kurir Tracking</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading
            <div class="sidebar-heading">
                Addons
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded">
                        <a class="text-white collapse-item" href="{{route('device.index')}}">Devices</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
                    aria-expanded="true" aria-controls="collapseSettings">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseSettings" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded">
                        <a class="text-white collapse-item" href="{{route('users.index')}}">Users</a>
                        <a class="text-white collapse-item" href="{{route('roles.index')}}">Roles</a>
                        <a class="text-white collapse-item" href="{{route('parameter.index')}}">Parameter</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport"
                    aria-expanded="true" aria-controls="collapseReport">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Report</span>
                </a>
                <div id="collapseReport" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded">
                        <a class="text-white collapse-item" href="{{route('dr.index')}}">Delivery Realization</a>
                        <a class="text-white collapse-item" href="{{route('pu.index')}}">Pick Up</a>
                        <a class="text-white collapse-item" href="{{route('kt.index')}}">Kurir Tracking</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider
            <hr class="sidebar-divider d-none d-md-block"> -->

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi, {{ Auth::user()->name }}
                                    <br> {{Auth::user()->current_login_at}}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('sbadmin')}}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{asset('profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sbadmin')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('sbadmin')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script> src="../js/app.js"</script>
<script src="checked.js">

    <!-- Core plugin JavaScript-->
    <script src="{{asset('sbadmin')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('sbadmin')}}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{asset('sbadmin')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('sbadmin')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('sbadmin')}}/js/demo/datatables-demo.js"></script>
    <!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> -->
<script>
        $(document).ready(function() {
            // Triggered when the value of the "Vendor" select element changes
            $('#vendor_id').on('change', function() {
                var vendorId = $(this).val();

                // AJAX request to fetch offices based on the selected vendor
                $.ajax({
                    url: '/fetch-offices', // Replace with your actual route URL
                    type: 'GET',
                    data: {
                        vendor_id: vendorId,
                    },
                    success: function(response) {
                        // Clear the current options of the "Office" select element
                        $('#office_id').empty();

                        // Add options based on the response data
                        $.each(response.offices, function(key, value) {
                            $('#office_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
<script>
    $(document).ready(function() {
        // Triggered when the value of the "Province" select element changes
        $('#province_id').on('change', function() {
            var provinceId = $(this).val();

            // AJAX request to fetch cities based on the selected province
            $.ajax({
                url: '/fetch-cities', // Replace with your actual route URL
                type: 'GET',
                data: {
                    province_id: provinceId
                },
                success: function(response) {
                    // Clear the current options of the "City" select element
                    $('#city_id').empty();

                    // Add options based on the response data
                    $.each(response.cities, function(key, value) {
                        $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                    // Trigger the change event on the "City" select element to update the subdistricts
                    $('#city_id').trigger('change');
                }
            });
        });

        // Triggered when the value of the "City" select element changes
        $('#city_id').on('change', function() {
            var cityId = $(this).val();

            // AJAX request to fetch subdistricts based on the selected city
            $.ajax({
                url: '/fetch-subdistricts', // Replace with your actual route URL
                type: 'GET',
                data: {
                    city_id: cityId
                },
                success: function(response) {
                    // Clear the current options of the "Subdistrict" select element
                    $('#subdistrict_id').empty();

                    // Add options based on the response data
                    $.each(response.subdistricts, function(key, value) {
                        $('#subdistrict_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                    // Trigger the change event on the "Subdistrict" select element to update the villages
                    $('#subdistrict_id').trigger('change');
                }
            });
        });

        // Triggered when the value of the "Subdistrict" select element changes
        $('#subdistrict_id').on('change', function() {
            var subdistrictId = $(this).val();

            // AJAX request to fetch villages based on the selected subdistrict
            $.ajax({
                url: '/fetch-villages', // Replace with your actual route URL
                type: 'GET',
                data: {
                    subdistrict_id: subdistrictId
                },
                success: function(response) {
                    // Clear the current options of the "Village" select element
                    $('#village_id').empty();

                    // Add options based on the response data
                    $.each(response.villages, function(key, value) {
                        $('#village_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>

<!-- Datatable search tfoot -->
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#dataTable tfoot th').each( function () {
        var title = $('#dataTable thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search"/>' );
    } );
 
    // DataTable
    var table = $('#dataTable').DataTable();
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
</script>

</body>
<style>
    .page-heading{
        display:flex;
        justify-content: space-between;        
    }

    .btn-custom{
        background-color:#F28E31;
        color:white;
        font-weight:bold;
        border-radius:2rem;
    }

    /* table td {
transition: all .5s;
max-width: 360px;
white-space: nowrap;
text-overflow: ellipsis;
word-break: break-all;
} */

</style>
</html>