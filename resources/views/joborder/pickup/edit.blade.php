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
    <h1 class="h3 mb-2 text-gray-800">Edit Pick Up</h1>
    <a href="javascript:history.back()" class="btn btn-custom">Back</a>
</div>
<br>    
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        
        <form action="{{ route('pickup.update', $pickup->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="table table-borderless" id="" cellspacing="0">
                <tbody>
                    <tr style="">
                        <td><b>Tanggal</b></td>
                        <td><b>:</b></td>
                        <td><input id="date_visit" type="text" class="form-control" name="date_visit" value="{{$pickup->date_visit}}" disabled></td>
                    </tr>
                    <tr style="">
                    <td><b>No Konsumen</b></td>
                        <td><b>:</b></td>
                        <td><input id="no_consumen" type="text" class="form-control" name="no_consumen" value="{{$pickup->no_consumen}}" disabled></td>
                    </tr>
                    <tr style="">
                    <td><b>Nama Konsumen</b></td>
                        <td><b>:</b></td>
                        <td><input id="name_consumen" type="text" class="form-control" name="name_consumen" value="{{$pickup->name_consumen}}" disabled></td>
                    </tr>
                    <tr style="">
                    <td><b>Alamat</b></td>
                        <td><b>:</b></td>
                        <td><input id="address" type="text" class="form-control" name="address" value="{{$pickup->address}}" disabled></td>
                    </tr>
                    <tr style="">
                    <td><b>Kode Pos</b></td>
                        <td><b>:</b></td>
                        <td><input id="zip_code" type="text" class="form-control" name="zip_code" value="{{$pickup->zip_code}}" disabled></td>
                    </tr>
                    <tr style="">
                    <tr style="">
                    <td><b>Kurir</b></td>
                    <td><b>:</b></td>
                    <td><select id="kurir_id" type="text" class="form-control" name="kurir_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($kurir as $kur)
                                @if ($pickup->kurir_id == $kur->id)
                                    <option value="{{$kur->id}}" selected>{{$kur->name}}</option>
                                @else
                                    <option value="{{$kur->id}}">{{$kur->name}}</option>
                                @endif
                            @endforeach
                            </select>
                    </td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons">
            <tr>
                <td><a href="{{route('pickup.index')}}" class="btn btn-primary cnclbtn">Cancel</a></td>
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
    $(document).ready(function() {
        $('.select2').select2({
            ajax: {
                url: '/get-vendors', // Ganti dengan URL yang sesuai untuk mengambil data village
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });
    });
</script>

@endsection
