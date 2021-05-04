@extends('admin.layout.master')
@section('sub-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Buyer's Details</h5>
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
    <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Top-->
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
                            <span class="font-size-h3 symbol-label font-weight-boldest">{{ucfirst(substr($user->first_name, 0, 1))."".ucfirst(substr($user->last_name, 0, 1))}}</span>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                            <!--begin::User-->
                            <div class="">
                                <input type="hidden" id="user_id" value="{{$user->id}}" style="display: none">
                                <!--begin::Name-->
                                <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$user->first_name}}  {{$user->last_name}}
                                    <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                <!--end::Name-->
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                                                <!--end::Svg Icon-->
                                        </span>{{$user->email}}</a>
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                                                <!--end::Svg Icon-->
                                        </span>{{$user->phone_number}}</a>
                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                            <!--begin::Actions-->
                            <div class="my-lg-0 my-1">
                                @if($user->status == true)
                                    <span class="btn btn-sm btn-success font-weight-bolder text-uppercase" disabled>Active</span>
                                @else
                                    <span class="btn btn-sm btn-warning font-weight-bolder text-uppercase" disabled>Suspended</span>
                                @endif
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2">
                                @if(isset($current_assignment))
                                    <p>Current Region: <span class="label label-lg label-light-primary label-inline font-weight-bold py-4">{{$current_assignment['region']->name}}</span>
                                        | Current tasked Raw Material: <span class="label label-lg label-light-primary label-inline font-weight-bold py-4">{{$current_assignment['raw_material']->name}}</span>
                                    <small>Change current assignment details <a href="{{route('admin.view-buyer-assignments', \Illuminate\Support\Facades\Crypt::encrypt($user->id))}}" >here</a></small></p>
                                @endif
                                   <p>Change current assignment details <a href="{{route('admin.view-buyer-assignments', \Illuminate\Support\Facades\Crypt::encrypt($user->id))}}" >here</a></p>
                            </div>
                            <!--end::Description-->
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
{{--                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">--}}
{{--												<span class="mr-4">--}}
{{--													<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>--}}
{{--												</span>--}}
{{--                        <div class="d-flex flex-column flex-lg-fill">--}}
{{--                            <span class="font-weight-bolder font-size-sm">Farmers</span>--}}
{{--                            <span class="font-weight-bolder font-size-h5">--}}
{{--							<span class="text-dark-50 font-weight-bold"></span>46</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <!--end::Bottom-->
            </div>
        </div>
    <!--end::Education-->
    <div class="card card-custom gutter-b">
        <div class="row">
            <div class="col-lg-12 order-1 order-xxl-2">
                <!--begin::List Widget 8-->
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            Monthly Transacted Amount
                        </div>
                        <div class="card-toolbar">
                            <div class="col" style="min-width: 170px">
                                <label for="month">Month</label>
                                    <input name='month' id='month' class="form-control" type="month" min="2021-04" value="{{now()->format('Y-m')}}" max="{{now()->format('Y-m')}}" required>
                            </div>
                            <div class="col">
                                <label for="month">Region</label>
                                <select class="form-control transaction-month" name="region" id="region" required>
                                    <option value="all" > All </option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}" {{($region->id == $current_region ) ? 'selected' : ''}}> {{$region->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <button class="btn btn-sm btn-success font-weight-bold" id="filter-transaction"> Filter <i class="fa fa-sm fa-sliders-h"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header py-3">
                            <div class="row d-flex justify-content-around">
                            </div>
                        </div>
                        <div class="card-body transaction-graph-card">
                            <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="transactionsChart" width="668" height="320" class="chartjs-render-monitor" style="display: block; width: 668px; height: 320px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Card-->
                <!--end::List Widget 8-->
            </div>
        </div>
    </div>

    <!--- Order Data Table -->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$user->full_name}}'s Orders (Purchases)</h3>
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
                    <th>Ref Number</th>
                    <th>Buyer</th>
                    <th>Region</th>
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

@endsection
@section('scripts')

    <script src="{{asset('assets/js/charts/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/buyer-chart-filter.js')}}"></script>
    <script>
        Chart.defaults.global.defaultFontFamily = 'Poppins';
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        /**
         * Transactions Graph
         **/
        const spinner =
            `<div class="d-flex justify-content-around loading-spinner">
               <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                   <span class="sr-only">Loading...</span>
               </div>
            </div>`;

        // draw graph Discussion Engagement on page load
        //let month = $("#month").val();
        let month ='current';
        let region = $("#region").val();
        var id = <?php echo $id ; ?>;
        $('.transaction-graph-card').prepend(spinner);
        $.get('monthly-purchases-filter-buyer/' + month + '/' + region+ '/' + id, function(data) {
            $('.transaction-graph-card .loading-spinner').remove();
            transactionsDrawGraph(data);
        });
        // on clicking filter
        $("#filter-transaction").on("click", function() {
            $('.transaction-graph-card .chart-bar').hide();
            $('.transaction-graph-card').prepend(spinner);

            //let year = $(".transaction-year").val();
            let region = $("#region").val();
            let month = $("#month").val();
            var id = <?php echo $id ; ?>;
            $.get('monthly-purchases-filter-buyer/' + month + '/' + region+ '/' + id, function(data) {
                $('.transaction-graph-card .chart-bar').show(500);
                $('.transaction-graph-card .loading-spinner').remove();
                transactionsDrawGraph(data);
            });

        });

        function transactionsDrawGraph(data){
            var elementId="transactionsChart"
            var chartType="bar"
            var labels = data.month
            var datasets = [
                {
                    label: "Disbursements Count",
                    type: 'line',
                    lineTension: 0.3,
                    backgroundColor: "rgba(219,141,13, 0.4)",
                    borderColor: "rgba(244,176,64,0.78)",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "rgba(219,141,13, 0.8)",
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(219,141,13, 0.8)",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    yAxisID: 'B',
                    data: data.post_count_data,
                },
                {
                    label: "Payment Amounts (Ksh.)",
                    type: 'bar',
                    backgroundColor: "rgba(162,31,37, 0.8)",
                    borderColor: "rgba(162,31,37, 0.8)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(171,53,58, 0.8)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(171,53,58, 0.8)",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    yAxisID: 'A',
                    data: data.payment_amount,
                },
            ]
            var unit ="month"
            var maxTicksLimitX = 7
            var maxTicksLimitY = 10
            // var maxY = 3500
            var maxY = data.max_Y_axis
            var maxYCount = data.max_daily

            drawEngagementGraph(elementId, chartType, labels, datasets, unit, maxTicksLimitX, maxTicksLimitY, maxY,maxYCount);
        }
    </script>

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
                        url: '{!! route('admin.get-buyer-orders', \Illuminate\Support\Facades\Crypt::encrypt($user->id)) !!}',
                        data: function (d) {
                            d.region_id = $('select[name=region_id]').val();
                            d.raw_material_id = $('select[name=raw_material_id]').val();
                        }
                    },
                    order:[0, 'desc'],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'ref_number', name: 'ref_number'},
                        {data: 'user.full_name', name: 'buyer'},
                        {data: 'order_region.region.name', name: 'region'},
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



