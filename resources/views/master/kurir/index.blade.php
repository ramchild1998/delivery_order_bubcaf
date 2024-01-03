@extends('layouts.app')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Data Kurir</h1>
    <button type="button" class="btn btn-custom">+ Add Kurir</button>
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
                        <th>NIK</th>
                        <th>Plat</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Kode Pos</th>
                        <th>Foto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>

                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Cedric Kelly</td>
                        <td>Senior Javascript Developer</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2012/03/29</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Airi Satou</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>33</td>
                        <td>2008/11/28</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Brielle Williamson</td>
                        <td>Integration Specialist</td>
                        <td>New York</td>
                        <td>61</td>
                        <td>2012/12/02</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Herrod Chandler</td>
                        <td>Sales Assistant</td>
                        <td>San Francisco</td>
                        <td>59</td>
                        <td>2012/08/06</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Rhona Davidson</td>
                        <td>Integration Specialist</td>
                        <td>Tokyo</td>
                        <td>55</td>
                        <td>2010/10/14</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Colleen Hurst</td>
                        <td>Javascript Developer</td>
                        <td>San Francisco</td>
                        <td>39</td>
                        <td>2009/09/15</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Sonya Frost</td>
                        <td>Software Engineer</td>
                        <td>Edinburgh</td>
                        <td>23</td>
                        <td>2008/12/13</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Jena Gaines</td>
                        <td>Office Manager</td>
                        <td>London</td>
                        <td>30</td>
                        <td>2008/12/19</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Donna Snider</td>
                        <td>Customer Support</td>
                        <td>New York</td>
                        <td>27</td>
                        <td>2011/01/25</td>
                        <td>Hehe</td>
                        <td>11162</td>
                        <td></td>
                        <td>Active</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection
