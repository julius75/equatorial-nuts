@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom card-transparent" style="margin-top: -5%;">
        <div class="card-body p-0">
            <!--begin::Wizard-->
            <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                <!--begin::Card-->
                <div class="card card-custom card-shadowless rounded-top-0">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                            <div class="col-xl-12 col-xxl-10">
                                <!--begin::Wizard Form-->
                                <form class="form" id="kt_form">
                                    {{csrf_field()}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold">Buying Centre's Details:</h5>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Region: {{$regions->name}}</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Buying Centre Name :</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('id_number') is-invalid @enderror" value="{{$center->name}}" id="name" name="name" type="text" required autocomplete="off"/>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
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

@endsection

