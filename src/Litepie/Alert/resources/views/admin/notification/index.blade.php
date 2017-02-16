@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('alert::notification.name') !!} <small> {!! trans('app.manage') !!} {!! trans('alert::notification.names') !!}</small>
@stop

@section('title')
{!! trans('alert::notification.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('alert::notification.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='alert-notification-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="alert-notification-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>Module</th>
        <th>User</th>
        <th>Action</th>
        <th>{!! trans('alert::notification.label.read_at')!!}</th>
        <th>{!! trans('alert::notification.label.created_at')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[type]')->raw()!!}</th>
        <th>{!! Form::text('search[notifiable_type]')->raw()!!}</th>
        <th>{!! Form::text('search[alert]')->raw()!!}</th>
        <th>{!! Form::date('search[read_at]')->raw()!!}</th>
        <th>{!! Form::date('date[created_at]')->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#alert-notification-entry', '{!!trans_url('admin/alert/notification/0')!!}');
    oTable = $('#alert-notification-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/alert/notification') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#alert-notification-list .search_bar input, #alert-notification-list .search_bar select').each(
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
            {data :'type'},
            {data :'user'},
            {data :'action'},
            {data :'read_at'},
            {data :'created_at'},
        ],
        "pageLength": 25
    });

    $('#alert-notification-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#alert-notification-list').DataTable().row( this ).data();

        $('#alert-notification-entry').load('{!!trans_url('admin/alert/notification/read')!!}' + '/' + d.id);
        $('#alert-notification-entry').load('{!!trans_url('admin/alert/notification')!!}' + '/' + d.id);

    });

    $("#alert-notification-list .search_bar input, #alert-notification-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });

    $("#alert-notification-list .search_bar input").on('change select', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

