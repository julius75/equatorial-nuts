@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Price Lists</h3>
            </div>
            <div class="card-toolbar">
                @hasanyrole('admin|general_management')
                <!--begin::Button-->
                    <a href="{{ route('admin.price-lists.create') }}" type="button" class="btn btn-secondary mr-2 font-weight-bolder">
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
                            </span>Set New Region Price
                    </a>
                    <!--end::Button-->
                @endhasanyrole
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Price Date</th>
                    <th>Region Name</th>
                    <th>Raw Material</th>
                    <th>Amount</th>
                    <th>Value</th>
                    <th>Unit</th>
                    <th>Current</th>
                    <th>Status</th>
                    <th>Created By</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
@endsection
@section('scripts')
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient = function() {
            var initTable1 = function() {
                var table = $('#kt_datatable');
                // begin first table
                table.DataTable({
                    responsive: true,
                    ajax: {
                        url: '{{route('admin.get-all-pricelists')}}',
                        type: 'GET',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'date', name: 'date'},
                        {data: 'region.name', name: 'region'},
                        {data: 'raw_material.name', name: 'raw_material'},
                        {data: 'amount', name: 'amount'},
                        {data: 'value', name: 'value'},
                        {data: 'unit', name: 'unit'},
                        {data: 'current', name: 'current'},
                        {data: 'approved', name: 'approved'},
                        {data: 'created_by.first_name', name: 'created_by'},
                    ],
                    columnDefs: [
                        {
                            width: '75px',
                            targets: -2,
                            render: function(data) {
                                var approved = {
                                    false: {'title': 'Pending Approval', 'state': 'warning'},
                                    true: {'title': 'Approved', 'state': 'success'}
                                };
                                if (typeof approved[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-' + approved[data].state + ' label-dot mr-2"></span>' +
                                    '<span class="font-weight-bold text-' + approved[data].state + '">' + approved[data].title + '</span>';
                            },
                        }, {
                            width: '75px',
                            targets: -3,
                            render: function(data) {
                                var approved = {
                                    false: {'title': 'Previous Price', 'state': 'warning'},
                                    true: {'title': 'Current Price', 'state': 'success'},
                                };
                                if (typeof approved[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-' + approved[data].state + ' label-dot mr-2"></span>' +
                                    '<span class="font-weight-bold text-' + approved[data].state + '">' + approved[data].title + '</span>';
                            },
                        },
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
@endsection

