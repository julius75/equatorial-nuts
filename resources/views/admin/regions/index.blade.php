@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom" style="margin-top: -5%;">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Registered Equitorial Nuts Regions
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
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable mt-10 datatable" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>County</th>
                    <th>Sub County</th>
                    <th>Buying Centers</th>
                    <th>Date Created</th>
                    <th>Action</th>
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
                <form method="POST" action="" id="editStatus">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="POST">
                    <div class="modal-header">
                        <div class="modal-title h4">Status update for selected Farmer</div>
                    </div>

                    <div class="modal-body overlay overlay-block cursor-default">
                        <div class="table-responsive">
                            <!--Table-->
                            <table class="table table-head-custom table-vertical-center overflow-hidden">
                                <thead>
                                <tr>
                                    <th>FULL NAME</th>
                                    <th>ID NUMBER</th>
                                    <th>STATUS</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                @foreach ($users as $user)--}}
                                <tr>
                                    <td id="fullname"></td>
                                    <td id="id_number"></td>
                                    <td id="status">
                                        <span class="label label-lg label-inline label-light-danger"></span>
                                    </td>
                                </tr>
                                {{--                                @endforeach--}}
                                </tbody>
                                <!--Table body-->
                            </table>
                        </div>
                    </div>
                    <div class="form modal-footer">
                        <div class="form-group mr-2">
                            <select class="form-control" name="status" id="statusValue">
                                <option value="true">Active</option>
                                <option value="false">Suspended</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-light btn-elevate mr-3" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-elevate">Update Status</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Confirmation</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Card-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Raw Material Details</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="name" name="name" placeholder="Product Name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDetail" class="col-sm-3 control-label">Details</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="details" name="details" placeholder="details" value="">
                            </div>
                        </div>
                    </form>
                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>--}}
{{--                    <input type="hidden" id="product_id" name="tour_id" value="0">--}}
{{--                </div>--}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-elevate mr-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-elevate">Save changes</button>
                </div>
            </div>
        </div>
    </div>

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
                        url: '{{route('admin.get-app-regions')}}',
                        type: 'GET',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'county', name: 'county'},
                        {data: 'sub_county', name: 'sub_county'},
                        {data: 'buying_center_count', name: 'buying_center_count'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'},
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        var user_id;
        $(document).ready(function(event){
            var table = $( "#kt_datatable" ).DataTable();
            table.on('click', '.delete', function(){
                jQuery.noConflict();
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });
            $('#ok_button').click(function(){
                $.ajax({
                    method: 'POST',
                   // url:"delete-regions/"+user_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            $('#confirmModal').modal('hide');
                            table.draw();
                        }, 2000);
                    }
                })
            });

        });
    </script>

@endsection

