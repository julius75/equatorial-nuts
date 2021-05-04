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
                <span class="text-muted font-weight-bold mr-4">#XRS-45670</span>
                <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">All View</a>
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
                            <span class="font-size-h3 symbol-label font-weight-boldest">MP</span>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                            <!--begin::User-->
                            <div class="mr-3">
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
                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                            <!--begin::Actions-->
                            <div class="my-lg-0 my-1">
                                <span class="btn btn-sm btn-primary font-weight-bolder text-uppercase" disabled>Active</span>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2">
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
                            <span class="font-weight-bolder font-size-sm">Total Amount</span>
                            <span class="font-weight-bolder font-size-h5">
													<span class="text-dark-50 font-weight-bold"></span>998</span>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Daily Transaction</span>
                            <span class="font-weight-bolder font-size-h5">
							<span class="text-dark-50 font-weight-bold"></span>461,120</span>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column flex-lg-fill">
                            <span class="font-weight-bolder font-size-sm">Farmers</span>
                            <span class="font-weight-bolder font-size-h5">
							<span class="text-dark-50 font-weight-bold"></span>46</span>
                        </div>
                    </div>
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
                            Monthly Transacted Amount: {{$current}}
                        </div>
                        <div class="card-toolbar">
                            <div class="col" style="min-width: 170px">
                                <label for="month">Month</label>
                                    <input name='month' id='month' class="form-control" type="month" min="2021-04" max="{{now()->format('M')}}">
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

@endsection
@section('scripts')

    <script src="{{asset('assets/js/charts/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/buyer-chart-filter.js')}}"></script>
    <script>
        Chart.defaults.global.defaultFontFamily = 'Poppins';
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



