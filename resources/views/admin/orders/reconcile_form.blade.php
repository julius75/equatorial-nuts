@extends('admin.layout.master')
@section("styles")
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/datepicker/jquery.datetimepicker.css')}}">
@stop
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="text-dark font-weight-bold">Create a Transaction for Order {{$order->ref_number}}</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.orders.show', $order->ref_number) }}" type="button" class="btn btn-primary font-weight-bolder">
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
                    </span>View Order Deatails
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <!--begin::Wizard-->
            <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                <!--begin::Card-->
                <div class="card card-custom card-shadowless rounded-top-0">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                            <div class="col-xl-12">
                                <!--begin::Wizard Form-->
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.orders.reconciliation.post', $order->ref_number)}}">
                                   @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="date_disbursed" class="col-form-label">Date Disbursed</label>
                                                            <div class="input-group input-group-solid input-group-lg">
                                                                <input required id="date_disbursed" name="date_disbursed" type="text" class="form-control form-control-solid form-control-lg @error('date_disbursed') is-invalid @enderror" value="{{ old('date_disbursed') }}"/>
                                                                 <div class="input-group-append"  data-toggle="datetimepicker">
                                                                    <span class="input-group-text">
                                                                     <i class="ki ki-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                @error('date_disbursed')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                                @enderror
                                                            </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="transaction_receipt" class="col-form-label">MPESA Transaction Receipt</label>
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input id="transaction_receipt" style="text-transform:uppercase" name="transaction_receipt" type="text" class="form-control form-control-solid form-control-lg @error('transaction_receipt') is-invalid @enderror" value="{{ old('transaction_receipt') }}"
                                                                  minlength="10" maxlength="12" required  autocomplete="off"/>
                                                            @error('transaction_receipt')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="channel" class="col-form-label">Disbursement Channel</label>
                                                        <select class="form-control form-control-lg form-control-solid" id="channel" name="channel">
                                                                <option selected value="MPESA DISBURSEMENT RECONCILIATION">
                                                                    MPESA DISBURSEMENT RECONCILIATION
                                                                </option>
                                                        </select>
                                                        @error('channel')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                      </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                            </div>
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Actions-->
                                            <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                                            <a href="{{route('admin.orders.order_disbursement_reconciliation')}}" class="btn btn-sm btn-secondary font-weight-bolder border-top px-9 py-4">Back</a>
                                            <!--end::Wizard Actions-->
                                        </div>
                                    </div>
                                </form>
                                <!--end::Wizard Form-->
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Wizard-->
        </div>
    </div>
    <!--end::Card-->
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/datepicker/jquery.datetimepicker.full.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            "use strict";
            jQuery('#date_disbursed').datetimepicker({
                format:'Y-m-d H:i',
                maxDate : '+1w'
            });
        })
    </script>
@endsection

