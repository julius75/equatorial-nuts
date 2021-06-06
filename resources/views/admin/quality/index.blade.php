@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-4">
                                <span class="symbol symbol-50 symbol-light-info ">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-xl svg-icon-info">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-dark-75 font-weight-bolder font-size-h3">{{$reviewedOrders}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Your Reviewed Orders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-4">
                                <span class="symbol symbol-50 symbol-light-success ">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-xl svg-icon-success">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-dark-75 font-weight-bolder font-size-h3">{{$ordersPendingReview}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Orders Pending Review</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-4">
                                <span class="symbol symbol-50 symbol-light-warning ">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-xl svg-icon-warning">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-dark-75 font-weight-bolder font-size-h5">{{$allReviewedOrders}}</span>
                                    <span class="text-muted font-weight-bold mt-2">All Reviewed Orders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mt-5 card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">All Orders (Purchases)</h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="filter_form" method="post" action="">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-1 col-form-label text-lg-right font-weight-bolder" for="region_id">Region:</label>
                                    <div class="col-md-2" style="margin-left: -20px;">
                                        <select class="js-example-basic-single form-control{{ $errors->has('region_id') ? ' is-invalid' : '' }}" name="region_id" required>
                                            <option value="all">All</option>
                                            @foreach($regions as $region)
                                                <option  value="{{$region->id}}">{{ucfirst($region->name)}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <label class="col-md-2 col-form-label text-lg-right font-weight-bolder" for="material">Raw Materials:</label>
                                    <div class="col-md-2" style="margin-left: -20px;">
                                        <select class="js-example-basic-single form-control" name="raw_material_id" required>
                                            <option value="all">All</option>
                                            @foreach($raw_materials as $raw_material)
                                                <option value="{{$raw_material->id}}">{{ucfirst($raw_material->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-md-1 col-form-label text-lg-right font-weight-bolder" for="buyer_id">Buyer:</label>
                                    <div class="col-md-2" style="margin-left: -20px;">
                                        <select class="js-example-basic-single form-control{{ $errors->has('buyer_id') ? ' is-invalid' : '' }}" name="buyer_id" required>
                                            <option value="all">All</option>
                                            @foreach($buyers as $buyer)
                                                <option  value="{{$buyer->id}}">{{ucfirst($buyer->first_name.' '.$buyer->last_name)}}</option>
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
                    <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Ref Number</th>
                            <th>Buyer</th>
                            <th>Region</th>
                            <th>Raw Material</th>
                            <th>Bags</th>
                            <th>Net Weight</th>
                            <th>Reviewed</th>
                            <th>Reviewed By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
        </div>
    </div>

    <!--end::Card-->
@endsection
@section('scripts')
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient = function() {
            var initTable1 = function() {
                var table = $('#kt_datatable').DataTable({
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
                        url: '{!! route('admin.get-quality-management-orders') !!}',
                        data: function (d) {
                            d.region_id = $('select[name=region_id]').val();
                            d.buyer_id = $('select[name=buyer_id]').val();
                            d.raw_material_id = $('select[name=raw_material_id]').val();
                        }
                    },
                    order:[0, 'desc'],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'ref_number', name: 'ref_number'},
                        {data: 'user.full_name', name: 'buyer'},
                        {data: 'order_region.region.name', name: 'region'},
                        {data: 'order_raw_material.raw_material.name', name: 'raw_material'},
                        {data: 'order_raw_material.bags', name: 'bags'},
                        {data: 'order_raw_material.net_weight', name: 'net_weight'},
                        {data: 'reviewed', name: 'reviewed'},
                        {data: 'reviewed_by', name: 'reviewed_by'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', searchable:false, orderable:false},
                    ],
                    columnDefs: [
                        {
                            width: '75px',
                            targets: -4,
                            render: function(data) {
                                var disbursed = {
                                    false: {'title': 'Pending Review', 'state': 'warning'},
                                    true: {'title': 'Reviewed', 'state': 'success'}
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
                $('#filter_form').on('submit', function(e) {
                    table.draw();
                    e.preventDefault();
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
@endsection

