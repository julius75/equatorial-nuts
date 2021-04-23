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
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.app-regions.store')}}">
                                    {{csrf_field()}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold">Add Region's Details:</h5>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Region Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" type="text" required autocomplete="off"/>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">County Name</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control form-control-lg form-control-solid county_id" id='sel_depart' name='county_id'>
                                                            <option selected disabled value="" >-- Select County --</option>
                                                            <!-- Read Departments -->
                                                            @foreach($departmentData as $department)
                                                                <option value='{{ $department->id }}'>{{ $department->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <!--begin::Group-->
                                                <br><br>
                                                <!--end::Group-->
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Sub County Name</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select required class="form-control form-control-lg form-control-solid sub_county_id" id='sel_emp' name='sub_county_id' autocomplete="off">
                                                            <option value='0'>-- Select Sub County --</option>
                                                        </select>
                                                    </div>
                                                </div>

{{--                                                <div class="form-group row">--}}
{{--                                                    <label class="col-form-label col-xl-3 col-lg-3">Materials</label>--}}
{{--                                                    <div class="col-xl-9 col-lg-9">--}}
{{--                                                        <select required class="form-control form-control-lg form-control-solid selectpicker" multiple=""  name="raw_material_ids[]">--}}
{{--                                                            <option selected disabled value="">Select Material</option>--}}
{{--                                                            @foreach($materials as $material)--}}
{{--                                                                <option  value="{{$material->id}}">{{ucfirst($material->name)}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Actions-->

                                            <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                                            <a href="{{route('admin.app-regions.index')}}" class="btn btn-success font-weight-bolder border-top px-9 py-4">Back</a>

                                            <!--end::Wizard Actions-->
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
    <script src="{{asset('assets/js/pages/custom/user/add-user.js')}}"></script>
    <script src="{{asset('assets/js/jquery.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            jQuery.noConflict();
            $('.county_id').select2();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            jQuery.noConflict();
            $('.sub_county_id').select2();
        });
    </script>
    <script type='text/javascript'>

        $(document).ready(function(){
            jQuery.noConflict();
            // Department Change
            $('#sel_depart').change(function(){
                // Department id
                var id = $(this).val();
                // Empty the dropdown
                $('#sel_emp').find('option').not(':first').remove();
                // AJAX request
                $.ajax({
                    url:  APP_URL +'/admin/getSubCounty/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){

                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                            // Read data and create <option >
                            for(var i=0; i<len; i++){

                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='"+id+"'>"+name+"</option>";

                                $("#sel_emp").append(option);
                            }
                        }

                    }
                });
            });

        });

    </script>
@endsection

