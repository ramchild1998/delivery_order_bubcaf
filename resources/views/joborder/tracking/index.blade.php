@extends('layouts.app')

@section('content')
<style>
        /* Set the dimensions of the map container */
        #map {
            width: 95%;
            height: 400px;
            margin: 2rem;
            border-radius: 1rem;
        }
        
 </style>
 <div style="margin:2rem;" class="card shadow mb-4">
    <div class="card-body">
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
    </div>
    </div>

<div id="map"></div>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoiam9uYXRoYW5kamFqYSIsImEiOiJjbHJhOWlvdmIwYWZwMmt2eG45eWZvcTd5In0.kH7MOsKxIQD7I7r4pazCBQ';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [106.7808918,-6.1651407], // Set the center to Indonesia coordinates [longitude, latitude]
        zoom: 15 
    });
</script>
@endsection
