@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Submit an Inventory Review for Order {{$order->ref_number}}</h3>
                    </div>
                    <div class="card-toolbar">
                    </div>
                </div>
                <div class="card-body">
                    <form id="filter_form" method="post" action="{{route('admin.order-inventory-management.post-review', $order->ref_number)}}">
                        <div class="form-group row">
                            <label class="col-xl-2 col-lg-2 col-form-label">Accepted Gross Weight (QM Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->accepted_gross_weight ?? '--' }}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">kg</span></div>
                                </div>
                            </div>
                            <label class="col-xl-2 col-lg-2 col-form-label">Accepted Net Weight (QM Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->accepted_net_weight ?? '--' }}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">kg</span></div>
                                </div>
                            </div>
                            <label class="col-xl-2 col-lg-2 col-form-label">Rejected Gross Weight (QM Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->rejected_gross_weight ?? '--'}}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">kg</span></div>
                                </div>
                            </div>
                            <label class="col-xl-2 col-lg-2 col-form-label">Rejected Net Weight (QM Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->rejected_net_weight ?? '--'}}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">kg</span></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @csrf
                        <div class="form-group row">
                            <label class="col-xl-2 col-lg-2 col-form-label">Raw Material (Buyer Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->raw_material->name }}" type="text"  autocomplete="off"/>
                                </div>
                            </div>

                            <label for="raw_material_id" class="col-xl-2 col-lg-2 col-form-label">Raw Material Review</label>
                            <div class="col-lg-4 col-xl-4">
                                <select class="form-control form-control-solid form-control-lg @error('gross_weight') is-invalid @enderror" name="raw_material_id" id="raw_material_id" required>
                                    <option disabled value="">Confirm Raw Material</option>
                                    @foreach($raw_materials as $raw_material)
                                        <option value="{{$raw_material->id}}" {{($raw_material->id ==  $order->order_raw_material->raw_material->id) ? 'selected' : ''}}>{{ucfirst($raw_material->name)}}</option>
                                    @endforeach
                                </select>
                                @error('raw_material_id')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-lg-2 col-form-label">Gross Weight (Buyer Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->gross_weight }}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">kg</span></div>
                                </div>
                            </div>

                            <label for="gross_weight" class="col-xl-2 col-lg-2 col-form-label">Gross Weight Review</label>
                            <div class="col-lg-4 col-xl-4">
                                <input id="gross_weight" class="form-control form-control-solid form-control-lg @error('gross_weight') is-invalid @enderror" value="{{ old('gross_weight') }}" name="gross_weight" type="number" min="0.001" step="0.001" max="100000000" autocomplete="off" required />
                                @error('gross_weight')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-lg-2 col-form-label">Net Weight (Buyer Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->net_weight }}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">kg</span></div>
                                </div>
                            </div>

                            <label for="net_weight" class="col-xl-2 col-lg-2 col-form-label">Net Weight Review</label>
                            <div class="col-lg-4 col-xl-4">
                                <input id="net_weight" class="form-control form-control-solid form-control-lg @error('net_weight') is-invalid @enderror" value="{{ old('net_weight') }}" name="net_weight" type="number" min="0.001" step="0.001" max="100000000" autocomplete="off" required />
                                @error('net_weight')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-lg-2 col-form-label">No. of Bags(Buyer Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->bags }}" type="text"  autocomplete="off"/>
                                    <div class="input-group-append"><span class="input-group-text">count</span></div>
                                </div>
                            </div>

                            <label for="bags" class="col-xl-2 col-lg-2 col-form-label">No. of Bags Review</label>
                            <div class="col-lg-4 col-xl-4">
                                <input id="bags" class="form-control form-control-solid form-control-lg @error('bags') is-invalid @enderror" value="{{ old('bags') }}" name="bags" type="number" min="1" step="1" max="100000000" autocomplete="off" required />
                                @error('bags')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-lg-2 col-form-label">Bag Type (Buyer Submission)</label>
                            <div class="col-lg-4 col-xl-4">
                                <div class="input-group bg-secondary">
                                    <input readonly class="bg-secondary form-control" value="{{ $order->order_raw_material->bag_type->name }}" type="text"  autocomplete="off"/>
                                </div>
                            </div>

                            <label for="bag_type_id" class="col-xl-2 col-lg-2 col-form-label">Bag Type Review</label>
                            <div class="col-lg-4 col-xl-4">
                                <select class="form-control form-control-solid form-control-lg @error('bag_type_id') is-invalid @enderror" name="bag_type_id" id="bag_type_id" required>
                                    <option disabled value="">Confirm Bag Type</option>
                                    @foreach($bag_types as $type)
                                        <option value="{{$type->id}}" {{($type->id ==  $order->order_raw_material->bag_type->id) ? 'selected' : ''}}>{{ucfirst($type->name)}}</option>
                                    @endforeach
                                </select>
                                @error('bag_type_id')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

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
