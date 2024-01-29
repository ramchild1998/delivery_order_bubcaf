@extends('layouts.app')

@section('content')
<style>
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

</style>

<div class="container-fluid">

<!-- Page Heading -->
<div class="page-heading">
    <h1 class="h3 mb-2 text-gray-800">Edit Users</h1>
    <button type="button" class="btn btn-custom">back</button>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <table class="table table-borderless" id="" cellspacing="0">
                <tbody>
                <tr style="">
                <td><b>Vendor</b></td>
                        <td><b>:</b></td>
                        <td><select id="vendor_id" type="text" class="form-control" name="vendor_id">
                            <option">-- Pilih --</option>
                            @foreach ($vendors as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                            @endforeach
                        </select></td>
                        <td><b>Contact Number</b></td>
                        <td><b>:</b></td>
                        <td><input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ $user->contact_number }}"></td>
                    </tr>
                    <tr style="">
                    <td><b>Office</b></td>
                        <td><b>:</b></td>
                        <td><select id="office_id" type="text" class="form-control" name="office_id">
                            <option">-- Pilih --</option>
                            @foreach ($offices as $office)
                            <option value="{{$office->id}}">{{$office->name}}</option>
                            @endforeach
                        </select></td>
                        <td><b>Role</b></td>
                        <td><b>:</b></td>
                        <td><select id="role_id" type="text" class="form-control" name="role_id">
                            <option">-- Pilih --</option>
                            @foreach ($role as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                    <td><b>Name</b></td>
                        <td><b>:</b></td>
                        <td><input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"></td>
                        <td><b>Username</b></td>
                        <td><b>:</b></td>
                        <td><input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}"></td>
                    </tr>
                    <tr style="">
                        <td><b>Email</b></td>
                        <td><b>:</b></td>
                        <td><input id="email" type="email" class="form-control" name="email" value="{{$user->email}}"></td>
                        <td><b>Status</b></td>
                        <td><b>:</b></td>
                        <td><label class="switch">
                        <input id="Uhui" type="checkbox" name="is_active" data-old_value="old_value" {{$user->is_active ? 'checked' : ''}} onchange="toggleCheckbox(this)">
                            <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <tr style="">
                        <td><b>Password</b></td>
                        <td><b>:</b></td>
                        <td><input id="password" type="password" class="form-control" name="password" placeholder="PASSWORD DI HIDDEN!" ></td>
                    </tr>
                    <tr>
                    <td><b>Confirm Password</b></td>
                        <td><b>:</b></td>
                        <td><input id="c_password" type="password" class="form-control" name="c_password" placeholder="PASSWORD DI HIDDEN!" ></td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons">
            <tr>
                <td><a href="{{ route('users.index') }}" class="btn btn-primary cnclbtn">Cancel</a></td>
                <td><button type="submit" class="btn btn-primary svbtn">Update</button></td>
            </tr>
            </div>
           
        </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->
<!-- SCRIPT -->
<script>
    // function toggleCheckbox(checkbox) {
    //     checkbox.value = checkbox.checked ? true : false;
    //     if (!checkbox.checked) {
    //         checkbox.value = false;
    //     }
    // }

function toggleCheckbox(checkbox) {
    checkbox.value = checkbox.checked ? true : false;
    if (!checkbox.checked) {
        var toggleElement = document.getElementById('toggleCheckbox');
        var oldValue = toggleElement.dataset.old_value;
        if (oldValue) {
            checkbox.value = oldValue;
        } else {
            checkbox.value = false;
        }
    }
}
</script>
@endsection