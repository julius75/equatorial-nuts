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
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.raw-materials.store.requirement')}}">
                                    {{csrf_field()}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h3 class="text-dark font-weight-bold">Add a new {{$rawMaterial->name}} Requirement</h3>
                                                <input hidden name="raw_material_id" value="{{$rawMaterial->id}}">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="parameter" class="col-form-label">Parameter Name </label>
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input id="parameter" name="parameter" type="text" class="form-control form-control-solid form-control-lg @error('parameter') is-invalid @enderror" value="{{ old('parameter') }}" required autofocus/>
                                                            @error('parameter')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="type" class="col-form-label"> Requirement Type </label>
                                                            <select required class="form-control form-control-lg form-control-solid  @error('type') is-invalid @enderror" id="type" name="type">
                                                                <option disabled selected value="">Specify Requirement Type</option>
                                                                <option value="percentage">Percentage</option>
                                                                <option value="integer">Integer</option>
                                                                <option value="text">Text</option>
                                                            </select>
                                                            @error('type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                          </span>
                                                            @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="value" class="col-form-label"> Requirement Value </label>
                                                        <select required class="form-control form-control-lg form-control-solid  @error('value') is-invalid @enderror" id="value" name="value">
                                                            <option disabled selected value="">Specify Requirement Value</option>
                                                            <option value="MAX">MAX</option>
                                                            <option value="MIN">MIN</option>
                                                            <option value="null">Null</option>
                                                        </select>
                                                        @error('value')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <div class="col-md-9">
                                                        <label id="requirement_label" for="requirement" class="col-form-label">Requirement</label>
                                                            <div class="input-group input-group-solid input-group-lg">
                                                                <input id="requirement" type="text" class="form-control form-control-solid form-control-lg @error('requirement') is-invalid @enderror" value="{{ old('requirement') }}"
                                                                        name="requirement" required autofocus/>
                                                                @error('requirement')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                                @enderror
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="unit" class="col-form-label">Unit <small>eg. "%", "nuts", leave empty if none</small></label>
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input id="unit" type="text" class="form-control form-control-solid form-control-lg @error('unit') is-invalid @enderror" value="{{ old('unit') }}"
                                                                   name="unit" autofocus/>
                                                            @error('unit')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                              </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                            </div>
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Actions-->
                                            <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                                            <a href="{{route('admin.raw-materials.view.requirement', $rawMaterial->id)}}" class="btn btn-sm btn-secondary font-weight-bolder border-top px-9 py-4">Back</a>
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
            document.getElementById('type').addEventListener('change', function(evt) {
                var type = this.selectedOptions[0].value;
                console.log(type);
                if (type === "percentage")
                {
                    console.log("inside if");
                    document.getElementById('requirement').setAttribute('type', 'number');
                    document.getElementById('requirement').setAttribute('min', "1");
                    document.getElementById('requirement').setAttribute('max', "100");
                    document.getElementById('requirement').setAttribute('step', "0.01");
                    document.getElementById('unit').value = "%";
                    document.getElementById('requirement_label').textContent = 'Requirement'+'('+type+')';
                }
                else if (type === "integer")
                {
                    document.getElementById('requirement').setAttribute('type', 'number');
                    document.getElementById('requirement').setAttribute('min', "1");
                    document.getElementById('requirement').setAttribute('max', "100000");
                    document.getElementById('requirement').setAttribute('step', "0.01");
                    document.getElementById('unit').value = "";
                    document.getElementById('requirement_label').textContent = 'Requirement'+'('+type+')';
                }
                else
                    {
                    document.getElementById('requirement').setAttribute('type', 'text');
                    document.getElementById('unit').value = "";
                    document.getElementById('requirement_label').textContent = 'Requirement'+'('+type+')';
                }
            })
        });
    </script>
@endsection

