@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom" style="margin-top: -5%;">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    {{$buyer->full_name}}'s ENP Region and Raw Material Assignments
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="" data-toggle="modal" data-target="#smallModal" id="smallButton" type="button" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Assign to a new Region / Raw Material
                </a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable mt-10 datatable" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Region</th>
                    <th>Raw Material</th>
                    <th>Status</th>
                    <th>Assigned By</th>
                    <th>Assigned At</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="smallModal" role="dialog">
        <div class="modal-dialog" style="min-height: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title h5">Assign to New Region / Raw Material</div>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.update-buyer-assignment', \Illuminate\Support\Facades\Crypt::encrypt($buyer->id))}}" id="editStatus">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="region" class="col-form-label col-xl-3 col-lg-3">Region</label>
                            <div class="col-xl-9 col-lg-9">
                                <select id="region" required class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" name="region_id" >
                                    <option selected disabled value="">Select Region</option>
                                    @foreach($regions as $region)
                                        <option  value="{{$region->id}}">{{ucfirst($region->name)}}</option>
                                    @endforeach
                                </select>
                                @error('region_id')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="raw_material_id" class="col-form-label col-xl-3 col-lg-3">Raw Material</label>
                            <div class="col-xl-9 col-lg-9">
                                <select id="raw_material_id" required class="form-control form-control-lg form-control-solid @error('raw_material_id') is-invalid @enderror" name="raw_material_id" >
                                    <option selected disabled value="">Select Region</option>
                                    @foreach($raw_materials as $raw_material)
                                        <option  value="{{$raw_material->id}}">{{ucfirst($raw_material->name)}}</option>
                                    @endforeach
                                </select>
                                @error('raw_material_id')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form modal-footer">
                            <div class="form-group">
                                <button type="button" class="btn btn-light btn-elevate mr-3" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-elevate">Assign</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Card-->
@endsection
@section('scripts')
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient = function() {

            var initTable1 = function() {
                var table = $('#kt_datatable');

                // begin first table
                table.DataTable({
                    responsive: true,
                    ajax: {
                        url: '{{route('admin.get-buyer-assignments', \Illuminate\Support\Facades\Crypt::encrypt($buyer->id))}}',
                        type: 'GET',
                        data: {
                            pagination: {
                                perpage: 50,
                            },
                        },
                    },
                    order:[0, 'DESC'],
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'region', name: 'region'},
                        {data: 'raw_material', name: 'raw_material'},
                        {data: 'current', name: 'current'},
                        {data: 'assigner', name: 'assigner'},
                        {data: 'assigned_at', name: 'assigned_at'},
                    ],

                    columnDefs: [
                        {
                            width: '75px',
                            targets: -3,
                            render: function(data, type, full, meta) {
                                var current = {
                                    false: {'title': 'Previous Assignment', 'state': 'warning'},
                                    true: {'title': 'Current Assignment', 'state': 'success'},
                                };

                                if (typeof current[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-' + current[data].state + ' label-dot mr-2"></span>' +
                                    '<span class="font-weight-bold text-' + current[data].state + '">' + current[data].title + '</span>';
                            },
                        },
                    ],
                });
            };

            return {

                //main function to initiate the module
                init: function() {
                    initTable1();
                },

            };

        }();

        jQuery(document).ready(function() {
            KTDatatablesDataSourceAjaxClient.init();
        });

    </script>
@endsection

