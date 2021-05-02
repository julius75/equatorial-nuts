@extends('admin.layout.master')
@section('styles')
@endsection
@section('sub-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{$page_description}}</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">Reference Number: {{$page_title}}</a>
                @if($order->disbursed == true)
                    <a href="#" class="ml-3 btn btn-light-success font-weight-bolder btn-sm">Order Status: Complete</a>
                @else
                        <a href="#" class="ml-3 btn btn-light-danger font-weight-bolder btn-sm">Order Status: Pending Buyer Disbursement</a>
                @endif
                <!--end::Actions-->
            </div>
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="mb-3 card">
                        <div class="card-body">
                            <ul class="list-group list-contacts">
                                <li class="list-group-item active"><a href="#" style="color: white">Buyer Details: </a></li>
                                <li class="list-group-item"><b>Name:</b> {{$order->user->full_name}}</li>
                                <li class="list-group-item"><b>Phone:</b> {{$order->user->phone_number}}</li>
                                <li class="list-group-item"><b>Email:</b> {{$order->user->email}}</li>
                            </ul>
                        </div>
                        <div class="card-body groups-contact mt-0">
                            <ul class="list-group">
                                <li class="list-group-item active"><a href="#" style="color: white">Farmer Details</a></li>
                                <li class="list-group-item justify-content-between">
                                    <b>Name:</b> {{$order->farmer->full_name}}
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>Phone:</b>
                                    {{$order->farmer->phone_number}}
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>ID Number:</b>
                                    {{$order->farmer->id_number}}
                                </li>
                            </ul>
                        </div>

                        <div class="card-body groups-contact mt-0">
                            <ul class="list-group">
                                <li class="list-group-item active"><a href="#" style="color: white">Raw Material Details</a></li>
                                <li class="list-group-item justify-content-between">
                                    <b>Name:</b> {{$order->order_raw_material->raw_material->name}}
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>Bag Type:</b>
                                    {{$order->order_raw_material->bag_type->name}}
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>Number of Bags:</b>
                                    {{$order->order_raw_material->bags}}
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>Net Weight:</b>
                                    {{$order->order_raw_material->net_weight}} Kg
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>Gross Weight:</b>
                                    {{$order->order_raw_material->gross_weight}} Kg
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label"> Order Region Details </h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-light-danger nav-bold nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_5_1">
                                            <span class="nav-icon"><i class="flaticon2-pin"></i></span>
                                            <span class="nav-text">Region</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5_2">
                                            <span class="nav-icon"><i class="flaticon2-map"></i></span>
                                            <span class="nav-text">Map</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_tab_pane_5_1" role="tabpanel" aria-labelledby="kt_tab_pane_5_1">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Region</th>
                                            <th scope="col">Buying Center</th>
                                            <th scope="col">County</th>
                                            <th scope="col">Sub County</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{$order->order_region->region->name}}</th>
                                            <td>{{$order->order_region->buying_center->name}}</td>
                                            @if($order->order_region->region->county != null)
                                                <td>{{$order->order_region->region->county->name}}</td>
                                            @else
                                                <td>--</td>
                                            @endif
                                            @if($order->order_region->region->sub_county != null)
                                                <td>{{$order->order_region->region->sub_county->name}}</td>
                                            @else
                                                <td>--</td>
                                            @endif
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_5_2" role="tabpanel" aria-labelledby="kt_tab_pane_5_2">
                                    <h6>Map</h6>
                                    <p>Coordinates at which the transaction was initiated</p>
                                    <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-8">
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Order Transaction</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable_02" style="margin-top: 13px !important">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Date Disbursed</th>
                                    <th>Mpesa Receipt</th>
                                    <th>Channel</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="mt-5 card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Order Quality Requirement Submission</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable" style="margin-top: 13px !important">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Required Value</th>
                                    <th>Submitted Value</th>
                                    <th>Time Posted</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-4">

                </div>
            </div>

        </div>
    </div>
    <!--end::Row-->
@endsection
@section('scripts')
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient = function() {
            var initTable1 = function() {
                var table = $('#kt_datatable');
                // begin first table
                table.DataTable({
                    dom: 'Bfrtip',
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
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{route('admin.get-order-raw-material-requirement-submissions', $order->ref_number)}}',
                        type: 'GET',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'active_raw_material_requirement.parameter', name: 'parameter'},
                        {data: 'active_raw_material_requirement.type', name: 'type'},
                        {data: 'active_raw_material_requirement.value', name: 'value'},
                        {data: 'active_raw_material_requirement.requirement', name: 'requirement'},
                        {data: 'value', name: 'value'},
                        {data: 'created_at', name: 'created_at'},
                        // {data: 'action', name: 'action'},
                    ],
                    columnDefs: [],
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

    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient2 = function() {
            var initTable2 = function() {
                var table2 = $('#kt_datatable_02');
                // begin first table
                table2.DataTable({
                    dom: 'Bfrtip',
                    buttons: [{extend: 'copyHtml5'},
                        {
                        extend: 'excelHtml5',
                        exportOptions: {columns: ':visible'},
                    },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {columns: ':visible'},
                            orientation: 'landscape',
                            pageSize: 'TABLOID'
                        }],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    searching:false,
                    ajax: {
                        url: '{{route('admin.get-order-mpesa-transaction', $order->ref_number)}}',
                        type: 'GET',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'amount', name: 'amount'},
                        {data: 'disbursed_at', name: 'disbursed_at'},
                        {data: 'transaction_receipt', name: 'transaction_receipt'},
                        {data: 'channel', name: 'channel'},
                    ],
                    columnDefs: [],
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
    @if($order->order_region->latitude && $order->order_region->longitude)
    <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>
    <script defer>
        function initialize() {
            var latLng = new google.maps.LatLng({{ $order->order_region->latitude }}, {{ $order->order_region->longitude }});
            var mapOptions = {
                zoom: 14,
                minZoom: 6,
                maxZoom: 17,
                zoomControl:true,
                zoomControlOptions: {
                    style:google.maps.ZoomControlStyle.DEFAULT
                },
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                panControl:false,
                mapTypeControl:false,
                scaleControl:false,
                overviewMapControl:false,
                rotateControl:false
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var image = new google.maps.MarkerImage("{{ asset('assets/media/pin.png') }}", null, null, null, new google.maps.Size(40,52));
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
                                                    <a href="{{ route('admin.orders.show', $order->ref_number) }}" title="View: {{ $order->ref_number }}">{{ $order->ref_number }}</a>
                                                </h4>
                                            </div>
                                            <a href="{{ route('admin.orders.show', $order->ref_number) }}"><img src="{{ asset('logo.jpeg') }}" alt="{{ $order->ref_number }}" class="align size-medium_large" width="120" height="120"></a>
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
                            <span class="geodir_post_meta_title">Order Ref Number: </span></span>{{ $order->ref_number }}</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Region: </span></span><span itemprop="streetAddress">{{ $order->order_region->region->name }}</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;
            var marker = new google.maps.Marker({
                position: latLng,
                icon:image,
                map: map,
                title: 'Order Ref:'+'{{ $order->ref_number }}'
            });
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, 'click', (function (marker) {
                return function () {
                    infowindow.setContent(content)
                    infowindow.open(map, marker);
                }
            })(marker));
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    @endif
@endsection

