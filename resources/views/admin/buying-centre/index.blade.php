@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom" style="margin-top: -5%;">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Registered Equitorial Nuts Buying Centre
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('admin.app-buying-centre.create') }}" type="button" class="btn btn-primary font-weight-bolder">
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
                    </span>Register New Buying Centre
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
                    <th>Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

    <!-- Modal -->
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
    <!-- Modal HTML Markup -->
    <div id="modal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Attach Raw Material To The Centre</h1>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="POST">
                        <div class="form-group row">
                            <label class="col-form-label col-xl-3 col-lg-3">Raw Material</label>
                            <div class="col-xl-9 col-lg-9">
                                <select required class="form-control form-control-lg form-control-solid selectpicker" name="name" id="elementId">
                                    <option disabled value="">Select Material</option>
                                    @foreach($materials as $material)
                                        <option  value="{{$material->id}}">{{ucfirst($material->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <span class="text-muted"> attach the raw material
                                    </span>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="ok_buttons">Save Material</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
                        url: APP_URL +'/admin/datatables/get-app-buying-centre',
                        type: 'GET',
                        data: {
                            pagination: {
                                perpage: 50,
                            },
                        },
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'region', name: 'region'},
                        {data: 'name', name: 'name'},
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
{{--    <script>--}}
{{--        var user_id;--}}
{{--        $(document).ready(function(event){--}}
{{--            var table = $( "#kt_datatable" ).DataTable();--}}
{{--            table.on('click', '.delete', function(){--}}
{{--                jQuery.noConflict();--}}
{{--                user_id = $(this).attr('id');--}}
{{--                $('#confirmModal').modal('show');--}}
{{--            });--}}
{{--            $('#ok_button').click(function(){--}}
{{--                $.ajax({--}}
{{--                    method: 'POST',--}}
{{--                    url:"delete-farmers/"+user_id,--}}
{{--                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
{{--                    beforeSend:function(){--}}
{{--                        $('#ok_button').text('Deleting...');--}}
{{--                    },--}}
{{--                    success:function(data)--}}
{{--                    {--}}
{{--                        setTimeout(function(){--}}
{{--                            $('#confirmModal').modal('hide');--}}
{{--                            table.draw();--}}
{{--                        }, 2000);--}}
{{--                    }--}}
{{--                })--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}
    <script>
        var user_id;
        $(document).ready(function(event){
            var table = $( "#kt_datatable" ).DataTable();
            table.on('click', '.materials', function(){
                jQuery.noConflict();
                user_id = $(this).attr('id');
                $('#modal').modal('show');

            });
            var e = document.getElementById("elementId");
            var value = e.options[e.selectedIndex].value;
            $('#ok_buttons').click(function(){

                $.ajax({
                    method: 'POST',
                    url:"buying-centre/"+user_id,
                    data:{
                        name:value,
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        alert(data.success)
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

