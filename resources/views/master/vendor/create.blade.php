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
    <h1 class="h3 mb-2 text-gray-800">Add Vendor</h1>
    <button type="button" class="btn btn-custom">back</button>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('vendor.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-borderless" id="" cellspacing="0">
                <tbody>
                    <tr style="">
                        <td><b>Name</b></td>
                        <td><b>:</b></td>
                        <td><input id="name" type="text" class="form-control" name="name"></td>
                    </tr>
                    <tr style="">
                        <td><b>PIC Name</b></td>
                        <td><b>:</b></td>
                        <td><input id="pic_name" type="text" class="form-control" name="pic_name"></td>
                    </tr>
                    <tr style="">
                        <td><b>PIC Contact Number</b></td>
                        <td><b>:</b></td>
                        <td><input id="pic_contact_num" type="text" class="form-control" name="pic_contact_num"></td>
                    </tr>
                    <tr style="">
                        <td><b>Status</b></td>
                        <td><b>:</b></td>
                        <td><label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons">
            <tr>
                <td><a href="{{route('vendor.index')}}" class="btn btn-primary cnclbtn">Cancel</a></td>
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
