@extends('layouts.app')

@section('content')

@guest
{{-- guest view --}}
@else

<div class="container-fluid mr-0" style="height:100%; overflow-y:hidden">
    <div class="row" style="height:100%; overflow-y:hidden">
        <div class="col-lg-3 mt-3">
            <h2 class="font-weight-bold">Recent Locations</h2>
            <p>overview of your last known positions</p>
            <p class="font-weight-bold mt-0 mb-0">Select your moki:</p>
            <select class="form-control col-lg-6 mb-5" id="device-selection">
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
                <ul>
                    <script>
                        jQuery(document).ready(function initMap($) {
                            map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: 34.144593, lng: -118.256121},
                                zoom: 8
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
                                        handlemarkers(response);
                                    }
                                });
                            });
                        });

                        function handlemarkers(response) {
                            var markerset = [];
                            $('.custom-control-input').change(function(){
                                var i = $(this).attr('id');
                                if ($('#'+ i).is(":checked")) {
                                    myLatLng = {lat: parseFloat(response[i].lat), lng: parseFloat(response[i].lng)};
                                    markerset[i] = new google.maps.Marker({
                                                    position: myLatLng, 
                                                    map: map,
                                                    title: 'Location ' + i
                                                    });
                                }
                                else {
                                    var i = $(this).attr('id');
                                    markerset[i].setMap(null);
                                };
                             });
                            console.log(response);
                        };
                    </script>
                    <div id="locations">
                        select your moki first
                    </div>
                </ul>
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