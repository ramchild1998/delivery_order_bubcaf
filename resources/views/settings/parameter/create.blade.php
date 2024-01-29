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
    <h1 class="h3 mb-2 text-gray-800">Add Users</h1>
    <button type="button" class="btn btn-custom">back</button>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('users.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-borderless" id="" cellspacing="0">
                <tbody>
                    <tr style="">
                        <td><b>Access Type</b></td>
                        <td><b>:</b></td>
                        <td><select id="type" type="text" class="form-control select2" name="type">
                            <option value="">-- Pilih --</option>
                            <option value="BCA">BCA</option>
                            <option value="Vendor">Vendor</option>
                            <option value="Office">Office</option>
                            <option value="Wilayah">Wilayah</option>
                        </select></td>
                        <td><b>Contact Number</b></td>
                        <td><b>:</b></td>
                        <td><input id="contact_number" type="text" class="form-control" name="contact_number"></td>
                    </tr>
                    <tr style="">
                        <td><b>Vendor</b></td>
                        <td><b>:</b></td>
                        <td><select id="vendor_id" type="text" class="form-control select2" name="vendor_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($vendors as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                            @endforeach
                        </select></td>
                        <td><b>Role</b></td>
                        <td><b>:</b></td>
                        <td><select id="role_type" type="text" class="form-control select2" name="role_type">
                            <option value="">-- Pilih --</option>
                            @foreach ($role as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                        <td><b>Office</b></td>
                        <td><b>:</b></td>
                        <td><select id="office_id" type="text" class="form-control select2" name="office_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($offices as $office)
                            <option value="{{$office->id}}">{{$office->name}}</option>
                            @endforeach
                        </select></td>
                        <td><b>Status</b></td>
                        <td><b>:</b></td>
                        <td><label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <tr style="">
                        <td><b>Name</b></td>
                        <td><b>:</b></td>
                        <td><input id="name" type="text" class="form-control" name="name"></td>
                    </tr>
                    <tr style="">
                        <td><b>Username</b></td>
                        <td><b>:</b></td>
                        <td><input id="username" type="text" class="form-control" name="username"></td>
                    </tr>
                    <tr style="">
                        <td><b>Email</b></td>
                        <td><b>:</b></td>
                        <td><input id="email" type="email" class="form-control" name="email"></td>
                    </tr>
                    <tr style="">
                        <td><b>Password</b></td>
                        <td><b>:</b></td>
                        <td><input id="password" type="password" class="form-control" name="password"></td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons">
            <tr>
                <td><a href="{{route('users.index')}}" class="btn btn-primary cnclbtn">Cancel</a></td>
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
        if (checkbox.checked) {
            checkbox.value = 0;
        } else {
            checkbox.value = 1;
        }
    }
</script>

@endsection
