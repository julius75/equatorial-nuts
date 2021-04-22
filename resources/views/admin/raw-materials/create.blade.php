@extends('admin.layout.master')
@section('content')
    <!--begin::Card-->
    <div class="card card-custom card-transparent">
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
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.price-lists.store')}}">
                                    {{csrf_field()}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h3 class="text-dark font-weight-bold">Set New Current Price</h3>
                                                <p class="text-dark font-weight-bold">Date will be set at {{now()->format('Y-m-d')}}</p>
                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <label for="region_id" class="col-form-label">Region </label>
                                                            <select class="form-control form-control-lg form-control-solid" id="region_id" name="region_id">
                                                                <option disabled selected value="">Specify Region</option>
                                                                @foreach($regions as $region)
                                                                    <option value="{{$region->id}}">
                                                                        {{$region->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('region_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                            @enderror
                                                    </div>
                                                    <div class="col-md-7">
                                                    <label for="raw_material_id" class="col-form-label">Raw Material </label>
                                                        <select class="form-control form-control-lg form-control-solid" id="raw_material_id" name="raw_material_id">
                                                            <option disabled selected value="">Specify Raw Material</option>
                                                            @foreach($raw_materials as $material)
                                                                <option value="{{$material->id}}">
                                                                    {{$material->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('raw_material_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                      </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="amount" class="col-form-label">Amount</label>
                                                            <div class="input-group input-group-solid input-group-lg">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <small>Ksh</small>
                                                                    </span>
                                                                </div>
                                                                <input id="amount" type="number" class="form-control form-control-solid form-control-lg is-invalid  @error('amount') is-invalid @enderror" value="{{ old('amount') }}"
                                                                        name="amount" step="0.01" min="1" max="100000" required autofocus/>
                                                                @error('amount')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                                @enderror
                                                            </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="value" class="col-form-label">Value <small>(for every x kg)</small></label>
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input id="value" name="value" type="number" class="form-control form-control-solid form-control-lg is-invalid  @error('value') is-invalid @enderror" value="{{ old('value') }}"
                                                                   step="1" min="1" max="1000" required autofocus/>
                                                            @error('value')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="unit" class="col-form-label">Unit</label>
                                                        <select class="form-control form-control-lg form-control-solid" id="unit" name="unit">
                                                                <option selected value="kg">
                                                                    Kilograms
                                                                </option>
                                                        </select>
                                                        @error('unit')
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
                                            <a href="{{route('admin.price-lists.index')}}" class="btn btn-sm btn-secondary font-weight-bolder border-top px-9 py-4">Back</a>
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
    <script>
        $(document).ready(function(){
            $('#inputState').change(function(){
                var main_menu_id = $('#inputState').val();
                axios.post('/submenus', {
                    main_menu_id: main_menu_id
                }).then((r)=>{
                    var submenus = r.data.submenus;
                    for(var i=0; i<submenus.length; i++){
                        $('#submenu').append('<option>'+submenus[i].title+'</option>');
                    }
                }).finally({

                });
            });
        });
    </script>
    <script src="{{asset('assets/js/pages/custom/user/add-user.js')}}"></script>
    <script>
        $( ".random" ).click(function( event ) {
            event.preventDefault();
            var rnd = Math.floor(Math.random() * 100000);
            document.getElementById('myText').value = "RUV".concat(rnd.toString());

        });
    </script>
@endsection

