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
    <h1 class="h3 mb-2 text-gray-800">Add Office</h1>
    <button type="button" class="btn btn-custom">back</button>
</div>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('office.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-borderless" id="" cellspacing="0">
                <tbody>
                    <tr style="">
                        <td><b>Name</b></td>
                        <td><b>:</b></td>
                        <td><input id="name" type="text" class="form-control" name="name" ></td>
                        <td><b>Zip Code</b></td>
                        <td><b>:</b></td>
                        <td><input id="zip_code" type="text" class="form-control" name="zip_code"></td>
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
                        <td><b>PIC Name</b></td>
                        <td><b>:</b></td>
                        <td><input id="pic_name" type="text" class="form-control" name="pic_name"></td>
                    </tr>
                    <tr style="">
                    <tr style="">

                    </tr>
                    <tr style="">
                        <td><b>Street</b></td>
                        <td><b>:</b></td>
                        <td><input id="address" type="text" class="form-control" name="address"></td>
                        <td><b>PIC Contact Number</b></td>
                        <td><b>:</b></td>
                        <td><input id="pic_contact_number" type="text" class="form-control" name="pic_contact_number"></td>
                    </tr>
                    <tr style="">
                    <td><b>Provinsi</b></td>
                        <td><b>:</b></td>
                        <td><select id="province_id" type="text" class="form-control" name="province_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($province->sortBy('name') as $province)
                            <option value="{{$province->id}}"  {{ $province->id == $selectedProvinceId ? 'selected' : '' }}>{{$province->name}}</option>
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
                        <td><b>Kota</b></td>
                        <td><b>:</b></td>
                        <td><select id="city_id" type="text" class="form-control"  name="city_id">
                            <option>-- Pilih --</option>
                            @foreach ($city->sortBy('name') as $city)
                            <option value="{{$city->id}}" {{ $city->id == $selectedCityId ? 'selected' : '' }}>{{$city->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                    <td><b>Kecamatan</b></td>
                        <td><b>:</b></td>
                        <td><select id="subdistrict_id" type="text" class="form-control" name="subdistrict_id">
                            <option>-- Pilih --</option>
                            @foreach ($subdistrict->sortBy('name') as $sub)
                            <option value="{{$sub->id}}" {{ $sub->id == $selectedSubId ? 'selected' : '' }}>{{$sub->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr style="">
                    <td><b>Kelurahan</b></td>
                        <td><b>:</b></td>
                        <td><select id="village_id" type="text" class="form-control" name="village_id">
                            <option>-- Pilih --</option>
                            @foreach ($village->sortBy('name') as $vil)
                            <option value="{{$vil->id}}"  {{ $vil->id == $selectedVillId ? 'selected' : '' }}>{{$vil->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons">
            <tr>
                <td><a href="{{route('office.index')}}" class="btn btn-primary cnclbtn">Cancel</a></td>
                <td><button type="submit" class="btn btn-primary svbtn">Save</button></td>
            </tr>
            </div>

        </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->

<!-- SCRIPT -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <script>
        const backButton = document.querySelector('.btn-custom');

        backButton.addEventListener('click', () => {
            history.back();
        });
    </script>

@endsection
