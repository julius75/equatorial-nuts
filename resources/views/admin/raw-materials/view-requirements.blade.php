@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom"style="margin-top: -5%;">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$raw_material->name}} Requirements</h3>
            </div>
            <div class="card-toolbar">
                @hasanyrole('admin|general_management')
                <!--begin::Button-->
                    <a href="{{ route('admin.raw-materials.create.requirement', $raw_material->id) }}" type="button" class="btn btn-secondary mr-2 font-weight-bolder">
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
                            </span>Add New Requirement
                    </a>
                    <!--end::Button-->
                @endhasanyrole
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Requirement</th>
                    <th>Unit</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.update-materials') }}" id="editStatus">
                    <input type="hidden" name="user_id" id="user_id" >
                    <input type="hidden" name="raw_material" value="{{$raw_material->id}}" id="raw_material" >
                    {{csrf_field()}}
                    <div class="modal-header">
                        <div class="modal-title h4">Edit {{$raw_material->name}} Requirement</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Parameter Name:</label>
                                <input id="parameter" name="parameter" type="text" class="form-control form-control-lg form-control-solid"/>
                                @error('parameter')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                          </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Requirement Type:</label>
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
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Requirement Value:</label>
                                <select required class="form-control form-control-lg form-control-solid @error('value') is-invalid @enderror" id="value" name="value">
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
                            <div class="col-lg-6">
                                <label>Requirement:</label>
                                <input id="requirement" type="text" class="form-control form-control-solid form-control-lg @error('requirement') is-invalid @enderror" value="{{ old('requirement') }}"
                                       name="requirement" required autofocus/>
                                @error('requirement')
                                <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="unit">Unit <small>eg. "%", "nuts", leave empty if none</small></label>
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
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                                <button type="button" class="btn btn-danger font-weight-bolder border-top px-9 py-4" data-dismiss="modal">Cancel</button>
                                <button id="ok_button" type="submit" class="btn btn-success font-weight-bolder border-top px-9 py-4">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{route('admin.get-raw-material-requirement-single', $raw_material->id)}}',
                        type: 'GET',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'parameter', name: 'parameter'},
                        {data: 'type', name: 'type'},
                        {data: 'value', name: 'value'},
                        {data: 'requirement', name: 'requirement'},
                        {data: 'unit', name: 'unit'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'},
                    ],
                    columnDefs: [],
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
        var raw_material;
        var user_id;
        $(document).ready(function(event){
            var table = $( "#kt_datatable" ).DataTable();
            table.on('click', '.delete', function(){
                jQuery.noConflict();
                //raw_material= document.getElementById( "raw_material" ).value;
                var user_id  =  $(this).data('id');
                var url = '{{ url("/admin/test", ["id",$raw_material->id]) }}';
                url = url.replace('id', user_id);
                $.get( url, function (data) {
                    $('#confirmModal').modal('show');
                    $('#user_id').val(data.data.id);
                     $('#parameter').val(data.data.parameter);
                    $('#type').val(data.data.type);
                    $('#value').val(data.data.value);
                    $('#requirement').val(data.data.requirement);
                    $('#unit').val(data.data.unit);
                })
                $('#ok_button').click(function(){
                    $.ajax({
                       // method: 'POST',
                       // url:"update-materials/"+user_id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        beforeSend:function(){
                            $('#ok_button').text('Updating...');
                        },
                        success:function(data)
                        {
                            setTimeout(function(){
                                $('#confirmModal').modal('hide');
                            }, 100);
                        }
                    })
                });
            });
        });
    </script>

@endsection

