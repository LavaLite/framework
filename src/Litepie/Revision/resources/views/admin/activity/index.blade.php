
@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('revision::activity.name') !!} <small> {!! trans('app.manage') !!} {!! trans('revision::activity.names') !!}</small>
@stop

@section('title')
{!! trans('revision::activity.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('revision::activity.names') !!}</li>
</ol>
@stop

@section('entry')
@stop

@section('tools')
@stop

@section('content')
<div class="modal fade" id="valueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #dd4b39;color: #fff;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h3 class="modal-title">Revision Values</h3>
        </div>
        <div class="modal-body" style="min-height:220px;">
            <div class='col-md-12'>
                <h5><b>Visitor IP address:</b></h5>
                <p class="remote"></p>
                <h5><b>Browser (User Agent) Info:</b></h5>
                <p class="agent"></p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

    </div>          
  </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#tab-activities" data-toggle="tab">Activities</a></li>
            <li><a href="{{trans_url('admin/revision/revision')}}">Revisions</a></li>
        </ul>
        <div class="tab-content">            
            <div class="tab-pane active" id="tab-activities">
                <table id="revision-activity-list" class="table table-striped  data-table">
                    <thead  class="list_head">
                        <th>Revision Name</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>user</th>
                        <th>User Info</th>
                        <th>Date</th>
                    </thead>
                     <thead  class="search_bar">
                        <th>{!! Form::text('search[name]')->raw()!!}</th>
                        <th>{!! Form::text('search[action]')->raw()!!}</th>
                        <th>{!! Form::text('search[activity_type]')->raw()!!}</th>
                        <th>{!! Form::text('search[user_id]')->raw()!!}</th>
                        <th></th>
                        <th>{!! Form::text('search[created_at]')->id('created_at')->raw()!!}</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
var oTable;
$(document).ready(function(){
    $("#created_at").datetimepicker({
        timepicker:false,
        format:'Y-m-d',
    });
    $("#updated_at").datetimepicker({
        timepicker:false,
        format:'Y-m-d',
    });
    oTable = $('#revision-activity-list').dataTable( {
         "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/revision/activity') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#revision-activity-list .search_bar input, #revision-activity-list .search_bar select').each(
                function(){
                    aoData.push( { 'name' : $(this).attr('name'), 'value' : $(this).val() } );
                }
            );
            app.dataTable(aoData);
            $.ajax({
                'dataType'  : 'json',
                'data'      : aoData,
                'type'      : 'GET',
                'url'       : sSource,
                'success'   : fnCallback
            });
        },

        "columns": [
            {data :'name'},
            {data :'action'},
            {data :'activity_type'},
            {data :'user_id'},
            {data :'user_info'},
            {data :'created_at'},
        ],
        "pageLength": 20
    });

    $('#revision-activity-list tbody').on( 'click', 'tr', function () {

        if ($(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var d = $('#revision-activity-list').DataTable().row( this ).data();

        $('#revision-activity-entry').load('{!!trans_url('admin/revision/activity')!!}' + '/' + d.id);

    });
     $("#revision-activity-list .search_bar input").on('keyup select', function (e) {
        e.preventDefault();
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
     $("#revision-activity-list .search_bar select, #creaed_at, #updated_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
     $(document).on('click','.valueModal', function (e) {
        e.preventDefault();

        $(".remote").html($(this).data('remote'));
        $(".agent").html($(this).data('agent'));
        $("#valueModal").modal('show');
    });
});
</script>
@stop

@section('style')
@stop

