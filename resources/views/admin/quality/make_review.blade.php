
@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Submit a Quality Review for Order {{$order->ref_number}}</h3>
                    </div>
                    <div class="card-toolbar">
                    </div>
                </div>
                <div class="card-body">
                    <form id="quality_submission" method="post" action="{{route('admin.order-quality-management.post-review', $order->ref_number)}}">
                        @csrf
                        <div class="form-group row">
                            <label for="submitted_gross_weight" class="col-xl-2 col-lg-2 col-form-label">Submitted Gross Weight</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input id="submitted_gross_weight" readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->gross_weight }}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">Kgs</span></div>
                                </div>
                            </div>
                            <label for="accepted_gross_weight" class="col-xl-2 col-lg-2 col-form-label">Accepted Gross Weight</label>
                            <div class="col-lg-4 col-xl-4">
                                <input id="accepted_gross_weight" class="form-control form-control-solid form-control-lg @error('accepted_gross_weight') is-invalid @enderror" value="{{ old('accepted_gross_weight') }}" name="accepted_gross_weight" type="number" step="0.01" min="0" max="1000000" autocomplete="off" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="submitted_net_weight" class="col-xl-2 col-lg-2 col-form-label">Submitted Net Weight</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input id="submitted_net_weight" readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->net_weight }}" type="text" autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">Kgs</span></div>
                                </div>
                            </div>
                            <label for="accepted_net_weight" class="col-xl-2 col-lg-2 col-form-label">Accepted Net Weight</label>
                            <div class="col-lg-4 col-xl-4">
                                <input id="accepted_net_weight" class="form-control form-control-solid form-control-lg @error('accepted_net_weight') is-invalid @enderror" value="{{ old('accepted_net_weight') }}" name="accepted_net_weight" type="number" step="0.01" min="0" max="1000000" autocomplete="off" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rejected_gross_weight" class="col-xl-2 col-lg-2 col-form-label">Rejected Gross Weight</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input id="rejected_gross_weight" readonly
                                           class="bg-secondary form-control form-control-solid form-control-lg @error('rejected_gross_weight') is-invalid @enderror"
                                           value="{{ old('rejected_gross_weight') }}"
                                           name="rejected_gross_weight" step="0.01" min="0" max="1000000" required
                                           type="number" autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">Kgs</span></div>
                                </div>
                            </div>
                            <label for="rejected_net_weight" class="col-xl-2 col-lg-2 col-form-label">Rejected Net Weight</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input id="rejected_net_weight" readonly
                                           class="bg-secondary form-control form-control-solid form-control-lg @error('rejected_net_weight') is-invalid @enderror"
                                           value="{{ old('rejected_net_weight') }}"
                                           name="rejected_net_weight" step="0.01" min="0" max="1000000"
                                           required
                                           type="number" autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">Kgs</span></div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label for="price_bought" class="col-xl-2 col-lg-2 col-form-label">Price per Kilo Bought</label>--}}
{{--                            <div class="col-lg-4 col-xl-4">--}}
{{--                                <div class="input-group bg-secondary">--}}
{{--                                    <input id="price_bought" readonly class="bg-secondary form-control" value="{{$order->price_list->amount}}" type="text" autocomplete="off"/>--}}
{{--                                    <div class="input-group-append"><span class="input-group-text">Ksh.</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <label for="reviewed_price" class="col-xl-2 col-lg-2 col-form-label">Price per Kilo Bought after Review</label>--}}
{{--                            <div class="col-lg-4 col-xl-4">--}}
{{--                                <div class="input-group bg-secondary">--}}
{{--                                    <input id="reviewed_price" readonly class="bg-secondary form-control" value="" type="text" autocomplete="off"/>--}}
{{--                                    <div class="input-group-append"><span class="input-group-text">Ksh</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <hr>

                        @foreach($order->raw_material_requirement_submissions as $submission)
                            <div class="form-group row">
                                <label class="col-xl-2 col-lg-2 col-form-label">{{$submission->raw_material_requirement->parameter}}</label>
                                <div class="col-lg-4 col-xl-4">
                                    <div class="input-group bg-secondary">
                                        <input readonly class="bg-secondary form-control" value="{{ $submission->value }}" type="text"  autocomplete="off"/>
                                        <div class="input-group-append"><span class="input-group-text">{{$submission->raw_material_requirement->unit}}</span></div>
                                    </div>
                                </div>
                                <label class="col-xl-2 col-lg-2 col-form-label">{{$submission->raw_material_requirement->parameter}} Review</label>
                                <div class="col-lg-4 col-xl-4">
                                    <input hidden value="{{ $submission->id }}"  name="submission_ids[]" />
                                    @if($submission->raw_material_requirement->type == "percentage" )
                                        <input class="form-control form-control-solid form-control-lg @error('value[]') is-invalid @enderror" value="{{ old('value[]') }}"  name="value[]" type="number" step="0.01" min="0" max="100" autocomplete="off" required />
                                    @elseif($submission->raw_material_requirement->type == "integer")
                                        <input class="form-control form-control-solid form-control-lg @error('value[]') is-invalid @enderror" value="{{ old('value[]') }}" name="value[]" type="number" step="0.01" min="0" max="1000000" autocomplete="off" required />
                                    @else
                                        <input class="form-control form-control-solid form-control-lg @error('value[]') is-invalid @enderror" value="{{ old('value[]') }}" name="value[]" type="text" autocomplete="off" required />
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                        <a href="{{route('admin.order-quality-management.make-review', $order->ref_number)}}" class="btn btn-success font-weight-bolder border-top px-9 py-4">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        if($("#quality_submission").length) {
            //calculate rejected gross weight
            $("#submitted_gross_weight").keyup(function () {
                $.subtractGross();
            });
            $("#accepted_gross_weight").keyup(function () {
                $.subtractGross();
            });
            $.subtractGross = function () {
                let accepted_gross_weight = parseFloat($("#accepted_gross_weight").val());
                if (accepted_gross_weight === null) {
                    accepted_gross_weight = 0;
                }
                let value = parseFloat($("#submitted_gross_weight").val()) - accepted_gross_weight;
                if (value < 0) {
                    value = 0
                }
                value = parseFloat(value.toFixed(4));

                $("#rejected_gross_weight").val(value);
            }
            //calculate rejected net weight
            $("#submitted_net_weight").keyup(function () {
                $.subtractNet();
            });
            $("#accepted_net_weight").keyup(function () {
                $.subtractNet();
            });
            $.subtractNet = function () {
                let accepted_net_weight = parseFloat($("#accepted_net_weight").val());
                if (accepted_net_weight === null) {
                    accepted_net_weight = 0;
                }
                let value = parseFloat($("#submitted_net_weight").val()) - accepted_net_weight;
                if (value < 0) {
                    value = 0
                }
                value = parseFloat(value.toFixed(4));

                $("#rejected_net_weight").val(value);
            }
        }
    });
</script>
@endsection

