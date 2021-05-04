@extends('admin.layout.master')
@section('sub-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{$page_title}}</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">{{$page_description}}</a>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Daterange-->
                <a href="#" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="Select dashboard daterange" data-placement="left">
                    <span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_daterangepicker_title">Last Updated</span>
                    <span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_daterangepicker_date">{{now()}}</span>
                </a>
                <!--end::Daterange-->
                <!--begin::Dropdowns-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-success svg-icon-lg">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right py-3">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover py-5">
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-drop"></i>
                                        </span>
                                    <span class="navi-text">New Group</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-list-3"></i>
														</span>
                                    <span class="navi-text">Contacts</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-rocket-1"></i>
														</span>
                                    <span class="navi-text">Groups</span>
                                    <span class="navi-link-badge">
															<span class="label label-light-primary label-inline font-weight-bold">new</span>
														</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
                                    <span class="navi-text">Calls</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-gear"></i>
														</span>
                                    <span class="navi-text">Settings</span>
                                </a>
                            </li>
                            <li class="navi-separator my-3"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-magnifier-tool"></i>
														</span>
                                    <span class="navi-text">Help</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
                                    <span class="navi-text">Privacy</span>
                                    <span class="navi-link-badge">
															<span class="label label-light-danger label-rounded font-weight-bold">5</span>
														</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
                <!--end::Dropdowns-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="container">
        <div class="row">
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
                                    <span class="text-dark-75 font-weight-bolder font-size-h3">{{$farmersCount}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Total Farmers</span>
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
                                    <span class="text-dark-75 font-weight-bolder font-size-h3">{{$buyingCentersCount}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Buying Centers</span>
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
                                    <span class="text-dark-75 font-weight-bolder font-size-h5">Ksh. {{number_format($transactionsAmount)}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Transacted Amount</span>
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
                                <span class="symbol symbol-50 symbol-light-danger ">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-xl svg-icon-danger">
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
                                    <span class="text-dark-75 font-weight-bolder font-size-h3">{{$buyersCount}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Total Buyers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-3" style="margin-bottom: 10px">
                <form method="post" action="{{route('admin.dashboard.filter')}}">
                    <label for="region">Filter Stats by Region</label>
                    <select name="region" id="region" class="form-control" onchange="this.form.submit()">
                        <option  value="all">All</option>
                        @foreach($regions as $region)
                            <option value="{{$region->id}}"  {{($region->id == $current_region ) ? 'selected' : ''}}>{{$region->name}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Monthly Transacted Amount : {{\Carbon\Carbon::now()->format('F - Y')}}</h3>
                        </div>
                        <div class="card-toolbar">
                            @hasanyrole('admin|general_management')
                            <a href="{{route('admin.dashboard.disbursed_payments_filter')}}" type="button" title="Filter payment records by past months" class="btn btn-secondary mr-2 font-weight-bolder">
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
                            </span> Filter
                            </a>
                            @endhasanyrole
                        </div>
                    </div>

                    <div class="card-header">
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <canvas id="transactionsChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/js/charts/Chart.min.js')}}"></script>
    <script>
        /**
         * Transactions Graph
         **/
        ( function ( $ ) {
            var repaymentsChart = {
                init: function () {
                    // -- Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Poppins';
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';
                    this.ajaxGetPaymentsMonthlyData();
                },

                ajaxGetPaymentsMonthlyData: function () {
                    var payments_month_array = <?php echo $monthly_payments_data_array ; ?>;
                    console.log( payments_month_array );
                    repaymentsChart.createCompletedPaymentsChart( payments_month_array );
                },

                /**
                 * Created the Completed Payments Chart
                 */
                createCompletedPaymentsChart: function ( payments_month_array ) {
                    var ctx = document.getElementById("transactionsChart");
                    var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: payments_month_array.month, // The response got from the ajax request containing all month names in the database
                            datasets: [{
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
                                yAxisID: 'A',
                                data: payments_month_array.post_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
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
                                    yAxisID: 'B',
                                    data: payments_month_array.payment_amount // The response got from the ajax request containing data for the completed jobs in the corresponding months
                                }
                            ],
                        },
                        options: {
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'date'
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 7
                                    }
                                }],
                                yAxes: [{
                                    id:'A',
                                    position: 'right',
                                    ticks: {
                                        min: 0,
                                        max: payments_month_array.max_payment, // The response got from the ajax request containing max limit for y axis
                                        maxTicksLimit: 5
                                    },
                                    gridLines: {
                                        display:false
                                    }
                                },
                                    {id:'B',
                                        position: 'left',
                                        ticks: {
                                            min: 0,
                                            max: payments_month_array.max_amount, // The response got from the ajax request containing max limit for y axis
                                            maxTicksLimit: 5
                                        },
                                        gridLines: {
                                            color: "rgba(0, 0, 0, .125)",
                                        }
                                    },
                                ],
                            },
                            legend: {
                                display: true
                            }
                        }
                    });
                }
            };
            repaymentsChart.init();
        } )( jQuery );
    </script>
    <script>
        // if (window.location.pathname === '/admin/dashboard') {
        //     var newText =  document.getElementsByClassName("menu-text");
        //     newText.innerHTML = 'new text here';
        // }
        // else {
        //     alert();
        //     //span.innerText = 'Dashboard';
        // }
    </script>
@endsection
