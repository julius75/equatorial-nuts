@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->

    <div class="row">
        <div class="col-md-6">
            <div class="card card-custom bg-success">
                <div class="card-header border-0">
                    <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-chat-1 text-white"></i>
            </span>
                        <h3 class="card-label text-white">
                            MPESA PAYBILL: {{$paybill}}
                        </h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="separator separator-solid separator-white opacity-20"></div>
                <div class="card-body text-white">
                    <h3 class="font-weight-boldest"> Utility Balance: {{$mpesa_paybill_balance}} </h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-custom bg-warning">
                <div class="card-header border-0">
                    <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-chat-1 text-white"></i>
            </span>
                        <h3 class="card-label text-white">
                            Africa's Talking Account Balance
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{route('admin.utility-balances')}}" class="btn btn-sm btn-white font-weight-bold">
                            <i class="flaticon2-cube"></i> Refresh
                        </a>
                    </div>
                </div>
                <div class="separator separator-solid separator-white opacity-20"></div>
                <div class="card-body text-white">
                   <h3 class="font-weight-boldest">{{$ATBalance}}</h3>
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
                        url: APP_URL +'/admin/datatables/get-app-users',
                        type: 'GET',
                        data: {
                            pagination: {
                                perpage: 50,
                            },
                        },
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'email', name: 'email'},
                        {data: 'phone_number', name: 'phone_number'},
                        {data: 'status', name: 'status'},
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
    <script>
        $(document).ready(function(event){
            var table = $( "#kt_datatable" ).DataTable();
            table.on('click','#smallButton', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')){
                        $tr = $tr.prev('.parent');
                            }
                        var data = table.row($tr).data();
                        console.log(data)
                $('#fname').html(data['first_name'])
                $('#lname').html(data['last_name'])
                if (data['status'] === true) {
                    $('#status').html('<span class="label label-lg label-inline label-light-primary">Active</span>')
                }
                else  $('#status').html('<span class="label label-lg label-inline label-light-primary">Suspended</span>')

                var statusValue = document.getElementById("statusValue").value;
                console.log(statusValue);
                jQuery.noConflict();
                $('#editStatus').attr('action','update-status/'+data['id']);
                $('#smallModal').modal('show');

            });
        });
    </script>
    <script>
        // display a modal (small modal)
        // $(document).ready(function () {
        //     var table = $('datatable').DataTable;
        //     table.on('click', '#smallButton', function(event) {
        //         alert();
        //         //event.preventDefault();
        //         $tr = $(this).closest('tr');
        //         if ($($tr).hasClass('child')){
        //             $tr = $tr.prev('.parent');
        //         }
        //         var data = table.row($tr).data();
        //
        //     });
        // });

    </script>

@endsection

