@extends('layouts.app')

@section('content')
<style>
    .buttons{
        display:flex;
        justify-content: end;
        margin:1rem;
    }
    .cnclbtn, .svbtn{
        border: none;
        font-weight:500;
        margin-right:1rem;
        background-color:#0D4685;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #EA7000;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Edit Role</h1>
    <button type="button" class="btn btn-custom">back</button>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('roles.update',  $role->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="table table-borderless" id="" cellspacing="0">
                <tbody>
                    <tr style="">
                        <td><b>Roles Name</b></td>
                        <td><b>:</b></td>
                        <td><input id="name" type="text" class="form-control" name="name" value="{{$role->name}}"></td>
                    </tr>
                    <tr style="">
                        <td><b>Access Type</b></td>
                        <td><b>:</b></td>
                        <td><select value= id="type" type="text" class="form-control select2" name="type">
                            <option value="{{$role->type}}">{{$role->type}}</option>
                            <option value="BCA">BCA</option>
                            <option value="Vendor">Vendor</option>
                            <option value="Office">Office</option>
                            <option value="Wilayah">Wilayah</option>
                        </select></td>
                    </tr>
                    <tr style="">
                        <td><b>Status</b></td>
                        <td><b>:</b></td>
                        <td>                        
                            <label class="switch">
                            <input id="Uhui" type="checkbox" name="is_active" {{$role->is_active ? 'checked' : ''}} onchange="toggleCheckbox(this)">
                            <span class="slider round"></span>
                        </label>
                        </td>
                    </tr>
                    <tr>
                        <td><input style="width:1.3rem; height:1.3rem;" type="checkbox" name="selectAll" class="selectAll" id="flexCheckIndeterminate"><span style="margin-left:1rem"> All Access Granted</span></td>
                    </tr>
                    <table class="table table-borderless" id="" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="padding-left: 4rem;" colspan=2>View Access</th>
                                <th style="padding-left: 13rem;" colspan=2>Create Access</th>
                                <th style="padding-left: 9rem;" colspan=2>Edit Access</th>
                            </tr>
                        </thead>
                <tbody>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Kurir</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Kurir</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Kurir</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Vendor</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Vendor</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Vendor</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Office</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Office</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Office</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Devices</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Devices</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Devices</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Users</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Users</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Users</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Roles</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Roles</td>
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Roles</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Pick Up</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Kurir Tracking</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Delivery Realization Report</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Pick Up Report</td>
                    </tr>
                    <tr style="">
                        <td align=right><input style="width:1.5rem; height:1.5rem;" type="checkbox" name="checkbox"></td>
                        <td>Kurir Tracking Report</td>
                    </tr>
                </tbody>
            </table>
                </tbody>
            </table>
            <div class="buttons">
            <tr>
                <td><a href="{{route('roles.index')}}" class="btn btn-primary cnclbtn">Cancel</a></td>
                <td><button type="submit" class="btn btn-primary svbtn">Save</button></td>
            </tr>
            </div>
        </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->

<!-- SCRIPT -->
<script>
    function toggleCheckbox(checkbox) {
        checkbox.value = checkbox.checked ? true : false;
        if (!checkbox.checked) {
            checkbox.value = false;
        }
    }
</script>

<script>
const checkbox = document.getElementById("flexCheckIndeterminate");
checkbox.addEventListener('input', evt => {
 const checked = evt.target.checked;
 const checkboxes = document.querySelectorAll('input[name="checkbox"]');
 checkboxes.forEach(checkbox => {
   checkbox.checked = checked;
 });
});
</script>

@endsection
