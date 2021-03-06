@extends('admin.layout.master')
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
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.app-users.store')}}">
                                    {{csrf_field()}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold">Add Buyer's Details:</h5>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" id="first_name" name="first_name" type="text" required autocomplete="off"/>
                                                        @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" name="last_name" id="last_name" type="text" required autocomplete="off"/>
                                                        @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="email" class="form-control form-control-solid form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                                                    name="email"  id="email" required  autocomplete="off"/>
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="number" class="form-control form-control-solid form-control-lg is-invalid  @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}"
                                                                   name="phone_number"  id="phone_number" required/>
                                                            @error('phone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Assigned Region</label>
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
                                                    <label for="raw_material_id" class="col-form-label col-xl-3 col-lg-3">Assigned Raw Material</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select id="raw_material_id" required class="form-control form-control-lg form-control-solid" name="raw_material_id" >
                                                            <option selected disabled value="">Select Raw Material</option>
                                                            @foreach($raw_materials as $material)
                                                                <option  value="{{$material->id}}">{{ucfirst($material->name)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Password</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input  class="form-control form-control-solid form-control-lg" name="password" type="password" id="myText" placeholder="Password" readonly autocomplete="off"/>
                                                            <button class="btn btn btn-success random"style="margin-left: 4%;">Generate Code</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--begin::Group-->

                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <!--end::Group-->
                                            </div>
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Actions-->

                                                    <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                                            <a href="{{route('admin.app-users.index')}}" class="btn btn-success font-weight-bolder border-top px-9 py-4">Back</a>

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
    <script>
        $( ".random" ).click(function( event ) {
            event.preventDefault();
            var rnd = Math.floor(Math.random() * 100000);
            document.getElementById('myText').value = "ENP".concat(rnd.toString());

        });
    </script>
@endsection

