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
    <h1 class="h3 mb-2 text-gray-800">Edit Kurir</h1>
    <a href="javascript:history.back()" class="btn btn-custom">Back</a>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        
        <form action="{{ route('kurir.update', $kurir->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="table table-borderless" id="" cellspacing="0">
                <tbody>
                    <tr style="">
                        <td><b>NIK</b></td>
                        <td><b>:</b></td>
                        <td><input id="nik" type="text" class="form-control" name="nik" value="{{$kurir->nik}}"></td>
                        <td><b>Kode Pos</b></td>
                        <td><b>:</b></td>
                        <td><input id="zip_code" type="text" class="form-control" name="zip_code" value="{{$kurir->zip_code}}"></td>
                    </tr>
                    <tr style="">
                    <td><b>Nama</b></td>
                        <td><b>:</b></td>
                        <td><input id="name" type="text" class="form-control" name="name" value="{{$kurir->name}}"></td>

                        <td><b>Provinsi</b></td>
                        <td><b>:</b></td>
                        <td><select id="province_id" type="text" class="form-control" name="province_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($province->sortBy('name') as $province)
                            <option value="{{$province->id}}"  {{ $province->id == $selectedProvinceId ? 'selected' : '' }}>{{$province->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                    <td><b>Vendor</b></td>
                        <td><b>:</b></td>
                        <td><select id="vendor_id" type="text" class="form-control" name="vendor_id">
                            <option">-- Pilih --</option>
                            @foreach ($vendors as $ven)
                            <option value="{{$ven->id}}">{{$ven->name}}</option>
                            @endforeach
                        </select></td>

                        <td><b>Kota</b></td>
                        <td><b>:</b></td>
                        <td><select id="city_id" type="text" class="form-control" name="city_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($city->sortBy('name') as $city)
                            <option value="{{$city->id}}" {{ $city->id == $selectedCityId ? 'selected' : '' }} >{{$city->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                    <td><b>Office</b></td>
                        <td><b>:</b></td>
                        <td><select id="office_id" type="text" class="form-control" name="office_id">
                            <option">-- Pilih --</option>
                            @foreach ($office as $off)
                            <option value="{{$off->id}}">{{$off->name}}</option>
                            @endforeach
                        </select></td>

                        <td><b>Kecamatan</b></td>
                        <td><b>:</b></td>
                        <td><select id="subdistrict_id" type="text" class="form-control" name="subdistrict_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($subdistrict->sortBy('name') as $sub)
                            <option value="{{$sub->id}}" {{ $sub->id == $selectedSubId ? 'selected' : '' }}>{{$sub->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                    <td><b>Plat Kendaraan</b></td>
                        <td><b>:</b></td>
                        <td><input id="plat_number" type="text" class="form-control" name="plat_number" value="{{$kurir->plat_number}}"></td>

                        <td><b>Kelurahan</b></td>
                        <td><b>:</b></td>
                        <td><select id="village_id" type="text" class="form-control" name="village_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($village->sortBy('name') as $vil)
                            <option value="{{$vil->id}}" {{ $vil->id == $selectedVillId ? 'selected' : '' }}>{{$vil->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                    <td><b>No HP</b></td>
                        <td><b>:</b></td>
                        <td><input id="no_hp" type="text" class="form-control" name="no_hp" value="{{$kurir->no_hp}}"></td>

                        <td><b>Foto</b></td>
                        <td><b>:</b></td>
                        <td><input id="foto" type="file" class="form-control" name="foto" enctype="multipart/form-data"></td>
                    </tr>
                    <tr style="">
                    <td><b>Alamat</b></td>
                        <td><b>:</b></td>
                        <td><input id="address" type="text" class="form-control" name="address" value="{{$kurir->address}}"></td>
                        <td><b>Status</b></td>
                    <td><b>:</b></td>
                    <td>
                    <label class="switch">
                        <input id="Uhui" type="checkbox" name="is_active" {{$kurir->is_active ? 'checked' : ''}} onchange="toggleCheckbox(this)">
                        <span class="slider round"></span>
                    </label>
                    </td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons">
            <tr>
                <td><a href="{{route('kurir.index')}}" class="btn btn-primary cnclbtn">Cancel</a></td>
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

@endsection
