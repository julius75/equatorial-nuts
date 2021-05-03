@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Geographical depiction of All Orders</h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <h5>Filter Orders</h5>
                    <form id="filter_form" method="post" action="{{route('admin.orders.map.post')}}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label text-lg-right font-weight-bolder" for="region_id">Region:</label>
                            <div class="col-md-2" style="margin-left: -20px;">
                                <select class="js-example-basic-single form-control{{ $errors->has('region_id') ? ' is-invalid' : '' }}" name="region_id" required>
                                    <option value="all">All</option>
                                    @foreach($regions as $region)
                                        <option  value="{{$region->id}}" {{($region->id == $current_region ) ? 'selected' : ''}}>{{ucfirst($region->name)}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <label class="col-md-2 col-form-label text-lg-right font-weight-bolder" for="material">Raw Materials:</label>
                            <div class="col-md-2" style="margin-left: -20px;">
                                <select class="js-example-basic-single form-control" name="raw_material_id" required>
                                    <option value="all">All</option>
                                    @foreach($raw_materials as $raw_material)
                                        <option value="{{$raw_material->id}}" {{($raw_material->id == $current_raw_material) ? 'selected' : ''}}>{{ucfirst($raw_material->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-1 col-form-label text-lg-right font-weight-bolder" for="buyer_id">Buyer:</label>
                            <div class="col-md-2" style="margin-left: -20px;">
                                <select class="js-example-basic-single form-control{{ $errors->has('buyer_id') ? ' is-invalid' : '' }}" name="buyer_id" required>
                                    <option value="all">All</option>
                                    @foreach($buyers as $buyer)
                                        <option  value="{{$buyer->id}}" {{($buyer->id == $current_buyer) ? 'selected' : ''}}>{{ucfirst($buyer->first_name.' '.$buyer->last_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success font-weight-bolder mr-2" id="">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;">
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>
    <script defer>
        function initialize() {
            var mapOptions = {
                zoom: 5,
                minZoom: 6,
                maxZoom: 17,
                zoomControl:true,
                zoomControlOptions: {
                    style:google.maps.ZoomControlStyle.DEFAULT
                },
                center: new google.maps.LatLng({{ $latitude }}, {{ $longitude }}),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: true,
                panControl:false,
                mapTypeControl:false,
                scaleControl:false,
                overviewMapControl:false,
                rotateControl:false
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var image = new google.maps.MarkerImage("{{ asset('assets/media/pin.png') }}", null, null, null, new google.maps.Size(40,52));
            var places = @json($mapOrders);
            console.log(places);
            for(place in places)
            {
                place = places[place];
                if(place.latitude && place.longitude)
                {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(place.latitude, place.longitude),
                        icon:image,
                        map: map,
                        title: place.name
                    });
                    var infowindow = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker, 'click', (function (marker, place) {
                        return function () {
                            infowindow.setContent(generateContent(place))
                            infowindow.open(map, marker);
                        }
                    })(marker, place));
                }
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        function generateContent(place)
        {
            var content = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="geodir-post-image geodir-images clearfix">
                                        <li>
                                            <div class="geodir-post-title">
                                                <h4 class="geodir-entry-title">
                                                    <a href="{{ route('admin.orders.show', '') }}/`+place.order.ref_number+`" title="View: `+place.order.ref_number+`">`+place.order.ref_number+`</a>
                                                </h4>
                                            </div>
                                            <a href="{{ route('admin.orders.show', '') }}/`+place.order.ref_number+`"><img src="{{ asset('logo.jpeg') }}" alt="`+place.order.ref_number+`" class="align size-medium_large" width="120" height="120"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Order Ref Number: </span></span>`+place.order.ref_number+`</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Region Tag: </span></span><span itemprop="streetAddress">`+place.region.name+`</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;

            return content;

        }
    </script>
@endsection

