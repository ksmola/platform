@extends('layouts.app')

@section('content')

@guest
{{-- guest view --}}
@else

<div class="container-fluid mr-0" style="height:100%;">
    <div class="row" style="height:100%;">
        <div class="col-lg-3 mt-3">
            <h2 class="font-weight-bold">Recent Locations</h2>
            <p>overview of your last known positions</p>
                <p class="font-weight-bold mt-0 mb-0">Select your moki:</p>
                <select class="form-control col-lg-6 mb-3" id="device-selection">
                    {{-- query devices from user table --}}
                    @if(is_array($devices) || is_object($devices))
                        @if(count($devices) > 0)
                            @foreach($devices as $device)
                                <option>{{$device->name}}</option>
                            @endforeach
                        @endif
                    @elseif(!is_array($devices) && !empty($devices)) {{--might be a little ambiguous?--}}
                        <option>{{$devices->name}}</option>
                    @elseif(empty($devices))
                        <option>NO MOKI FOUND!</option>
                    @endif
            </select>
                    <script>
                        jQuery(document).ready(function initMap($) {
                            map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: 34.144593, lng: -118.256121},
                                zoom: 8,
                                styles: [
                                        {
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#f5f5f5"
                                            }
                                            ]
                                        },
                                        {
                                            "elementType": "labels.icon",
                                            "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                            ]
                                        },
                                        {
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#616161"
                                            }
                                            ]
                                        },
                                        {
                                            "elementType": "labels.text.stroke",
                                            "stylers": [
                                            {
                                                "color": "#f5f5f5"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "administrative.land_parcel",
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#bdbdbd"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "poi",
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#eeeeee"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "poi",
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#757575"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "poi.park",
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#e5e5e5"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "poi.park",
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#9e9e9e"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "road",
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#ffffff"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "road.arterial",
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#757575"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "road.highway",
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#dadada"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "road.highway",
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#616161"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "road.local",
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#9e9e9e"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "transit.line",
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#e5e5e5"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "transit.station",
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#eeeeee"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "water",
                                            "elementType": "geometry",
                                            "stylers": [
                                            {
                                                "color": "#c9c9c9"
                                            }
                                            ]
                                        },
                                        {
                                            "featureType": "water",
                                            "elementType": "labels.text.fill",
                                            "stylers": [
                                            {
                                                "color": "#9e9e9e"
                                            }
                                            ]
                                        }
                                        ]
                            });
                            google.maps.event.addListenerOnce(map, 'idle', function(){
                                $("#device-selection").fadeIn("slow");
    // do something only the first time the map is loaded
                            }); 
                            $("#device-selection").change(function() {
                                $.ajax({
                                    url: '/tracking',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    type: 'POST',    
                                    dataType: 'json',
                                    data: { "name": $(this).val() }, 
                                    success: function initMap(response) {
                                        
                                        var pos_count = Object.keys(response).length;
                                        for (i = 0; i < pos_count; i++){
                                            var pos_list_1 = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="' + i + '"><label class="custom-control-label" for="' + i + '"><p class="font-weight-bold mt-0 mb-0">';
                                            var pos_list_2 = '</p><p class="text-muted mb-0">' + response[i].created_at + '</p></label></div>';
                                            if (i == 0){
                                                $('#locations').html(pos_list_1 + "Location " + i + pos_list_2);
                                            }
                                            else {
                                                $('#locations').append(pos_list_1 + "Location " + i + pos_list_2);
                                            }
                                        }
                                        if (pos_count > 1) {
                                            $('.select').html('<div class="custom-control form-check"><input class="form-check-input" type="checkbox" id="selectall"><label class="form-check-label" for="selectall">Select All</label></div>');
                                        }
                                        handlemarkers(response);
                                    }
                                });
                            });
                        });

                        function handlemarkers(response) {
                            var markerset = [];
                            var pos_count = Object.keys(response).length;
                            $('.form-check').change(function(){
                                if ($('#selectall').is(":checked")) {
                                    for (i=0; i<pos_count; i++){
                                        myLatLng = {lat: parseFloat(response[i].lat), lng: parseFloat(response[i].lng)};
                                        markerset[i] = new google.maps.Marker({
                                                        position: myLatLng, 
                                                        map: map,
                                                        title: 'Location ' + i,
                                                        icon: {
                                                            url: "pictures/mokimarker.png",
                                                            size: new google.maps.Size(96, 96),
                                                            scaledSize: new google.maps.Size(48,48),
                                                            anchor: new google.maps.Point(24,48)
                                                        }
                                                        });

                                    };
                                }
                                else {
                                    for (i=0; i<pos_count; i++){
                                        markerset[i].setMap(null);
                                    }
                                    
                                };
                                });
                            
                            $('.custom-control-input').change(function(){
                                var i = $(this).attr('id');
                                if ($('#'+ i).is(":checked")) {
                                    myLatLng = {lat: parseFloat(response[i].lat), lng: parseFloat(response[i].lng)};
                                    markerset[i] = new google.maps.Marker({
                                                    position: myLatLng, 
                                                    map: map,
                                                    title: 'Location ' + i,
                                                    icon: {
                                                        url: "pictures/mokimarker.png",
                                                        size: new google.maps.Size(96, 96),
                                                        scaledSize: new google.maps.Size(48,48),
                                                        anchor: new google.maps.Point(24,48)
                                                    }
                                                    });
                                }
                                else {
                                    var i = $(this).attr('id');
                                    markerset[i].setMap(null);
                                };
                             });
                        };

                        
                            // console.log(response);
                        
                    </script>
                    <div class="select"></div>
                    <div id="locations">
                        select your moki first
                    </div>
        </div>
        <div class="col-lg-9 bg-white mr-0 ml-0 pr-0 pl-0">
            <div id="map"></div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgn346QD68IVst958J18TjWAiRY-dNkVM&callback=initMap"
            async defer>
            </script>

        </div>
    </div>
</div>
    
@endguest
@endsection