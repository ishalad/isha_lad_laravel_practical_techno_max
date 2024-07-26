@extends('layouts.app')

@section('content')
<style type="text/css">
    #mymap {
        border: 1px solid red;
        width: 800px;
        height: 500px;
    }
</style>

<h1>Map Based Report</h1>
<div id="mymap" style="height: 500px; width: 100%;"></div>
@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtxbC4uhroIy-dEVsKFoqyv-JqD88dgP0&callback=initMap" async defer></script>

<script type="text/javascript">
    var locations = <?php echo json_encode($locations); ?>;

    function initMap() {
        var map = new google.maps.Map(document.getElementById('mymap'), {
            center: {lat: 21.170240, lng: 72.831061},
            zoom: 6
        });

        locations.forEach(function(location) {
            console.log(location);
            var marker = new google.maps.Marker({
                position: {lat: parseFloat(location.lat), lng: parseFloat(location.lon)}, 
                map: map,
                title: location.city
            });

            var infowindow = new google.maps.InfoWindow({
                content: 'This is ' + location.city + ', Gujarat from India.'
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        });
    }

    document.addEventListener('DOMContentLoaded', initMap);
</script>
@endsection
