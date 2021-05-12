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
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="container">
        <div class="mb-3 row justify-content-center">
            <div class="col-md-4">
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
                                    <span class="text-dark-75 font-weight-bolder font-size-h3">{{$disbCount ?? '--'}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Total Purchases</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>

            <div class="col-md-4">
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
                                    <span class="text-dark-75 font-weight-bolder font-size-h5">Ksh. {{number_format($disbAmount) ?? '--'}}</span>
                                    <span class="text-muted font-weight-bold mt-2">Transacted Amount</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">

                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Monthly Transacted Amount : {{$current}}</h3>
                        </div>
                        <div class="card-toolbar">
                           @if(auth()->user()->hasRole('admin'))
                                <form  class="form-inline row justify-content-center" method="post" action="{{route('admin.dashboard.disbursed_payments_filter.post')}}">
                                    @csrf
                                    <div class="col-md-4">
                                        <label for="month">Select Month</label>
                                        <div class="input-group">
                                            <input name='month' id='month' class="form-control" value="{{$current}}" type="month" min="2021-04" max="{{now()->format('Y-m')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="region">Select Region</label>
                                        <div class="input-group">
                                            <select class="js-example-basic-single form-control{{ $errors->has('region') ? ' is-invalid' : '' }}" name="region" id="region" required>
                                                <option value="all" > All </option>
                                                @foreach($regions as $region)
                                                    <option value="{{$region->id}}" {{($region->id == $current_region ) ? 'selected' : ''}}> {{$region->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('region'))
                                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="buyer">Select ENP Buyer</label>
                                        <div class="input-group">
                                            <select class="js-example-basic-single form-control{{ $errors->has('buyer') ? ' is-invalid' : '' }}" name="buyer" id="buyer" required>
                                                <option  value="all" > All </option>
                                                @foreach($buyers as $buyer)
                                                    <option  value="{{$buyer->id}}" {{($buyer->id == $current_buyer ) ? 'selected' : ''}} > {{$buyer->first_name}} {{$buyer->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('buyer'))
                                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('buyer') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-primary">Filter</button>
                                    </div>
                                </form>
                            @endif
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
