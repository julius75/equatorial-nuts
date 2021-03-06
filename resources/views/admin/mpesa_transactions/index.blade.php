@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">All Mpesa Transactions</h3>
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
                    <th>Order Ref Number</th>
                    <th>Transaction Receipt</th>
                    <th>Amount</th>
                    <th>Recipient Details</th>
                    <th>Buyer Details</th>
                    <th>Date Disbursed</th>
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
                        url: '{!! route('admin.get-mpesa-transactions') !!}',
                        data: function (d) {
                            d.region_id = $('select[name=region_id]').val();
                            d.raw_material_id = $('select[name=raw_material_id]').val();
                        }
                    },
                    order:[0, 'desc'],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'order_ref', name: 'order_ref',searchable:false, orderable:false},
                        {data: 'transaction_receipt', name: 'transaction_receipt'},
                        {data: 'amount', name: 'amount'},
                        {data: 'mpesa_recipient', name: 'mpesa_recipient'},
                        {data: 'buyer_details', name: 'buyer_details'},
                        {data: 'disbursed_at', name: 'disbursed_at'},
                    ],
                    columnDefs: [
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

