@extends('admin.layout.master')
@section('sub-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Farmer Details</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!--end::Actions-->
            </div>
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <!--begin::Top-->
            <div class="d-flex">
                <!--begin::Pic-->
                <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
                        <span class="font-size-h3 symbol-label font-weight-boldest">{{ucfirst(substr($farmer->full_name, 0, 2))}}</span>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin: Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                        <!--begin::User-->
                        <div class="">
                            <!--begin::Name-->
                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                {{$farmer->full_name}}
                                <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                            <!--end::Name-->
                        </div>
                        <!--begin::User-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <!--begin::Description-->
                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2">
                            <p>Phone Number: {{$farmer->phone_number}}</p>
                            <p>ID Number: {{$farmer->id_number}}</p>
                            <p>Gender: {{$farmer->gender}}</p>
                            <p>Current Region: {{$farmer->region->name}}</p>
                        </div>
                        <!--end::Description-->
                        <div class="my-lg-0 my-1">
                            <a class="mb-3 btn  btn-sm  btn-warning font-weight-bolder text-uppercase" href="{{route('admin.app-farmers.edit', \Illuminate\Support\Facades\Crypt::encrypt($farmer->id))}}">
                                Edit Farmer Details
                            </a>
                            <br>
                            @if($farmer->status == true)
                                <span class="btn btn-sm btn-success font-weight-bolder text-uppercase" disabled>Farmer status: Active</span>
                            @else
                                <span class="btn btn-sm btn-danger font-weight-bolder text-uppercase" disabled>Farmer status: Suspended</span>
                            @endif
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Top-->
            <!--begin::Separator-->
            <div class="separator separator-solid my-7"></div>
            <!--end::Separator-->
            <!--begin::Bottom-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
												</span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Total Number of Complete Orders (Purchases)</span>
                        <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold"></span>{{number_format($transactionsCount)}}</span>
                    </div>
                </div>
                <!--end: Item-->
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
												</span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Total Amount of Complete Orders (Purchases)</span>
                        <span class="font-weight-bolder font-size-h5">
							<span class="text-dark-50 font-weight-bold"></span>Ksh. {{number_format($transactionsAmount)}}</span>
                    </div>
                </div>
                <!--end: Item-->
                <!--begin: Item-->
            </div>
            <!--end::Bottom-->
        </div>
    </div>

    <!--- Order Data Table -->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$farmer->full_name}} Orders (Purchases)</h3>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="filter_form_orders" method="post" action="">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-lg-right font-weight-bolder" for="region_id">Buying Center:</label>
                            <div class="col-md-2" style="margin-left: -20px;">
                                <select class="js-example-basic-single form-control{{ $errors->has('buying_center_id') ? ' is-invalid' : '' }}" name="buying_center_id" required>
                                    <option value="all">All</option>
                                    @foreach($buying_centers as $center)
                                        <option  value="{{$center->id}}">{{ucfirst($center->name)}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <label class="col-md-2 col-form-label text-lg-right font-weight-bolder" for="material">Raw Materials:</label>
                            <div class="col-md-2" style="margin-left: -20px;">
                                <select class="js-example-basic-single form-control" name="raw_material_id" required>
                                    <option value="all">All</option>
                                    @foreach($materials as $raw_material)
                                        <option value="{{$raw_material->id}}">{{ucfirst($raw_material->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success font-weight-bolder mr-2" id="">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable_orders" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ref Number</th>
                    <th>Buyer</th>
                    <th>Buying Center</th>
                    <th>Amount</th>
                    <th>Raw Material</th>
                    <th>Bags</th>
                    <th>Net Weight</th>
                    <th>Disbursed</th>
                    <th>Date Disbursed</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

    <!--begin::Content-->
    <div class="mt-5 row">
        <div class="col-md-5">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--Begin::Header-->
                <!--end::Header-->
                <!--Begin::Body-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Farmer's Offered Raw Materials
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <!--begin::Button-->
                        <button data-toggle="modal" data-target="#exampleModalLong" type="button" class="btn btn-secondary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> Edit Raw Materials offered
                        </button>
                        <!--end::Button-->
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable mt-10 datatable" id="kt_datatable" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Raw Material</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-7">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label"> {{$farmer->full_name}} Map Overview</h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <h6>Map</h6>
                    <p>Coordinates at which the transactions were initiated</p>
                    <div id="map-canvas" style="min-height: 425px; width: 100%; position: relative; overflow: hidden;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
    <div id="exampleModalLong" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{route('admin.attach-raw-materials-to-farmer')}}" id="editStatus">
                    <input type="hidden" name="farmer_id" value="{{$farmer->id}}" >
                    {{csrf_field()}}
                    <div class="modal-header">
                        <div class="modal-title h4">Add new Raw Material to {{$farmer->full_name}}</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-xl-3 col-lg-3">Raw Materials Offered: </label>
                            <div class="col-xl-9 col-lg-9">
                                <div class="checkbox-list">
                                    @foreach($materials as $material)
                                        <label class="checkbox">
                                            <input type="checkbox" name="raw_material_ids[]" value="{{ $material->id }}" {{ $farmer->raw_materials->contains($material->id) ? 'checked' : '' }}>
                                            <span></span>
                                            {{ $material->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                                <button type="button" class="btn btn-danger font-weight-bolder border-top px-9 py-4" data-dismiss="modal">Cancel</button>
                                <button id="ok_button" type="submit" class="btn btn-success font-weight-bolder border-top px-9 py-4">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <!--raw_materials data table-->
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient = function() {
            var initTable1 = function() {
                var table = $('#kt_datatable');
                // begin first table
                table.DataTable({
                    responsive: true,
                    searching:false,

                    ajax: {
                        url: '{{route('admin.get-farmer-raw-materials', $farmer->id)}}',
                        type: 'GET',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                    ],
                    columnDefs: [
                    ],
                });

            };

            return {

                //main function to initiate the module
                init: function() {
                    initTable1();
                },

            };

        }();

        jQuery(document).ready(function() {
            KTDatatablesDataSourceAjaxClient.init();
        });

    </script>
    <!--order data table-->
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient2 = function() {
            var initTable2 = function() {
                var table2 = $('#kt_datatable_orders').DataTable({
                    dom: 'Bfrtip',
                    "processing": true,
                    "serverSide": true,
                    buttons: [{extend: 'copyHtml5'}, {
                        extend: 'excelHtml5',
                        exportOptions: {columns: ':visible'},
                    },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {columns: ':visible'},
                            orientation: 'landscape',
                            pageSize: 'TABLOID'
                        },
                        'colvis','pageLength'],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    responsive: true,
                    ajax: {
                        url: '{!! route('admin.get-farmer-orders', \Illuminate\Support\Facades\Crypt::encrypt($farmer->id)) !!}',
                        data: function (d) {
                            d.buying_center_id = $('select[name=buying_center_id]').val();
                            d.raw_material_id = $('select[name=raw_material_id]').val();
                        }
                    },
                    order:[0, 'desc'],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'ref_number', name: 'ref_number'},
                        {data: 'user.full_name', name: 'buyer'},
                        {data: 'order_region.buying_center.name', name: 'buying_center'},
                        {data: 'amount', name: 'amount'},
                        {data: 'order_raw_material.raw_material.name', name: 'raw_material'},
                        {data: 'order_raw_material.bags', name: 'bags'},
                        {data: 'order_raw_material.net_weight', name: 'net_weight'},
                        {data: 'disbursed', name: 'disbursed'},
                        {data: 'disbursed_at', name: 'disbursed_at'},
                        {data: 'action', name: 'action', searchable:false, orderable:false},
                    ],
                    columnDefs: [
                        {
                            width: '75px',
                            targets: -3,
                            render: function(data) {
                                var disbursed = {
                                    false: {'title': 'Pending Disbursal', 'state': 'warning'},
                                    true: {'title': 'Disbursed', 'state': 'success'}
                                };
                                if (typeof disbursed[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-' + disbursed[data].state + ' label-dot mr-2"></span>' +
                                    '<span class="font-weight-bold text-' + disbursed[data].state + '">' + disbursed[data].title + '</span>';
                            },
                        }
                    ],
                });
                $('#filter_form_orders').on('submit', function(e) {
                    table2.draw();
                    e.preventDefault();
                });
            };
            return {
                //main function to initiate the module
                init: function() {
                    initTable2();
                },
            };
        }();
        jQuery(document).ready(function() {
            KTDatatablesDataSourceAjaxClient2.init();
        });
    </script>
    <!--map-->
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
                            <span class="geodir_post_meta_title">Buying Center Tag: </span></span><span itemprop="streetAddress">`+place.buying_center.name+`</span>
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

