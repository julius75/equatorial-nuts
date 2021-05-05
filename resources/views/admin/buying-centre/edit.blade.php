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
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.app-buying-centre.update', $center->id)}}">
                                    {{csrf_field()}}
                                    <input hidden name="_method" value="put">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold">Edit Buying Centre's Details:</h5>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Buying Centre Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('id_number') is-invalid @enderror" value="{{ $center->name }}" id="name" name="name" type="text" required autocomplete="off"/>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="region_id" class="col-form-label col-xl-3 col-lg-3">Buying Center Region</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select id="region_id" required class="form-control form-control-lg form-control-solid" name="region_id" >
                                                            @foreach($regions as $region)
                                                                <option  value="{{$region->id}}" {{($region->id == $center->region->id ) ? 'selected' : ''}}>{{ucfirst($region->name)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Raw Materials Offered: </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <div class="checkbox-list">
                                                        @foreach($raw_materials as $material)
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="raw_material_ids[]" value="{{ $material->id }}" {{ $center->raw_materials->contains($material->id) ? 'checked' : '' }}>
                                                                <span></span>
                                                                {{ $material->name }}
                                                            </label>
                                                    @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                                                <a href="{{route('admin.app-buying-centre.index')}}" class="btn btn-success font-weight-bolder border-top px-9 py-4">Back</a>

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
        $('.date').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
    </script>
@endsection

