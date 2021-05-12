
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
                    <form id="filter_form" method="post" action="{{route('admin.order-quality-management.post-review', $order->ref_number)}}">
                        @csrf
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
                                        <input class="form-control form-control-solid form-control-lg @error('full_name') is-invalid @enderror" value="{{ old('value') }}"  name="value[]" type="number" step="0.01" min="0.01" max="100" autocomplete="off" required />
                                    @elseif($submission->raw_material_requirement->type == "integer")
                                        <input class="form-control form-control-solid form-control-lg @error('full_name') is-invalid @enderror" value="{{ old('value') }}" name="value[]" type="number" step="0.01" min="0.01" max="1000000" autocomplete="off" required />
                                    @else
                                        <input class="form-control form-control-solid form-control-lg @error('full_name') is-invalid @enderror" value="{{ old('value') }}" name="value[]" type="text" autocomplete="off" required />
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

@endsection

