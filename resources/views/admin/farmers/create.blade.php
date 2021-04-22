@extends('admin.layout.master')
@section('styles')
    <link href="{{asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .border-line{
            border: 1px solid #c3cad8;
        }
    </style>
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
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.app-farmers.store')}}">
                                    {{csrf_field()}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold">Add Farmer's Details:</h5>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Full Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" id="full_name" name="full_name" type="text" required autocomplete="off"/>
                                                        @error('full_name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg is-invalid  @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}"
                                                                   name="phone_number"  id="phone_number" required autofocus/>
                                                            @error('phone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">ID Number</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('id_number') is-invalid @enderror" value="{{ old('id_number') }}" id="id_number" name="id_number" type="text" required autocomplete="off"/>
                                                        @error('id_number')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Date of Birth</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" class="date form-control" name="date_of_birth"
                                                               placeholder="Enter date of birth" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Gender</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select required class="form-control form-control-lg form-control-solid" name="gender">
                                                            <option selected disabled value="">Select Gender</option>
                                                            <option value="MALE">Male</option>
                                                            <option value="FEMALE">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Region</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select required class="form-control form-control-lg form-control-solid" name="region_id" >
                                                            <option selected disabled value="">Select Region</option>
                                                            @foreach($regions as $region)
                                                                <option  value="{{$region->id}}">{{ucfirst($region->name)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Materials</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select required class="form-control form-control-lg form-control-solid selectpicker" multiple=""  name="raw_material_ids[]">
                                                            <option selected disabled value="">Select Material</option>
                                                            @foreach($materials as $material)
                                                                <option  value="{{$material->id}}">{{ucfirst($material->name)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Actions-->

                                                    <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                                            <a href="{{route('admin.app-farmers.index')}}" class="btn btn-success font-weight-bolder border-top px-9 py-4">Back</a>

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
    <script src="{{asset('assets/js/pages/custom/user/add-user.js')}}"></script>
    <script src="{{asset('assets/js/jquery.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>

        <script type="text/javascript">
            $('.date').datepicker({
                format: 'yyyy-mm-dd'
            });
    </script>
    </script>
@endsection

