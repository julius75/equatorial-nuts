@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Prices Pending Approval</h3>
            </div>
            <div class="card-toolbar">

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
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Actions</th>
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
                        url: '{{route('admin.get-pending-approval-pricelists')}}',
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
                        {data: 'approved', name: 'approved'},
                        {data: 'created_by.first_name', name: 'created_by'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'},
                    ],
                    columnDefs: [
                        {
                            width: '75px',
                            targets: -4,
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

