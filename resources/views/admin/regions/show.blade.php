@extends('admin.layout.master')
@section('content')
    <!--begin::Card-->
    <div class="d-flex flex-row" style="margin-top: -5%;">
        <!--begin::Aside-->
        <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
            <!--begin::Nav Panel Widget 2-->
            <div class="card card-custom gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Wrapper-->
                    <div class="d-flex justify-content-between flex-column pt-4 h-100">
                        <!--begin::Container-->
                        <div class="pb-5">
                            <!--begin::Header-->
                            <div class="d-flex flex-column flex-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-120 symbol-circle symbol-success overflow-hidden">
{{--																<span class="symbol-label">--}}
{{--																	<img src="{{asset('assets/media/placeholder.svg')}}" class="h-75 align-self-end" alt="" />--}}
{{--																</span>--}}
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Username-->
                                <!--end::Username-->
                                <!--begin::Info-->
                                <div class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">Region Name: </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="pt-1">
                                <!--begin::Text-->
                                <p class="text-dark-75 font-weight-nirmal font-size-sm m-0 pb-4 ml-14">County: <span class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder bg-success">{{$region->county->name}}</span></p>
                                <!--end::Text-->
                                <p class="text-dark-75 font-weight-nirmal font-size-sm m-0 pb-4 ml-14">Sub County: <span class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder bg-success">{{$region->sub_county->name}}</span></p>

                                <input type="hidden" id="region_id" value="{{$region->id}}" style="display: none">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light mr-4">
																	<span class="symbol-label">
																		<span class="svg-icon svg-icon-2x svg-icon-dark-50">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																					<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																					<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																					<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Buying Center</span>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">8</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light mr-4">
																	<span class="symbol-label">
																		<span class="svg-icon svg-icon-2x svg-icon-dark-50">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
																					<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Raw Materials</span>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">7</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--eng::Container-->
                        <!--begin::Footer-->
                        <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Nav Panel Widget 2-->
        </div>
        <!--end::Aside-->
        <!--begin::Content-->
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom gutter-bs">
                <!--Begin::Header-->
                <!--end::Header-->
                <!--Begin::Body-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Regions Raw Materials
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.app-regions.create') }}" type="button" class="btn btn-primary font-weight-bolder">
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
                    </span>Register New Region
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                 <table class="table table-bordered table-hover table-checkable mt-10 datatable" id="kt_datatable" style="margin-top: 13px !important">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Buying Centers</th>
                                        <th>Raw Material</th>
                                    </tr>
                                    </thead>
                                </table>

                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Education-->
@endsection
@section('scripts')
    <script src="{{asset('assets/js/pages/custom/education/student/profile.js')}}"></script>
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient = function() {
            var initTable1 = function() {
                var table = $('#kt_datatable');
                // begin first table
                table.DataTable({
                    responsive: true,
                    ajax: {
                        url: '{{route('admin.get-app-regions-raw',$region->id)}}',
                        type: 'GET',
                        data: {
                            pagination: {
                                perpage: 5,
                            },
                        },

                    },
                    stateSave: true,
                    "bDestroy": true,
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'materials', name: 'materials'},
                        {data: 'buying', name: 'buying'},
                    ],
                    columnDefs: [
                        {
                            width: '75px',
                            targets: -2,
                            render: function(data, type, full, meta) {
                                var is_active = {
                                    false: {'title': 'Suspended', 'state': 'danger'},
                                    true: {'title': 'Active', 'state': 'primary'},
                                    3: {'title': 'Direct', 'state': 'success'},
                                };

                                if (typeof is_active[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-' + is_active[data].state + ' label-dot mr-2"></span>' +
                                    '<span class="font-weight-bold text-' + is_active[data].state + '">' + is_active[data].title + '</span>';
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

