@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('user::user.name') !!} <small> {!! trans('app.manage') !!} {!! trans('user::user.names') !!}</small>
@stop

@section('title')
{!! trans('user::user.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('user::user.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='user-user-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="user-user-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>{!! trans('user::user.label.name')!!}</th>
        <th>{!! trans('user::user.label.email')!!}</th>
        <th>{!! trans('user::user.label.designation')!!}</th>
        <th>{!! trans('user::user.label.mobile')!!}</th>
        <th>{!! trans('user::user.label.status')!!}</th>
       
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th>{!! Form::text('search[email]')->raw()!!}</th>
        <th>{!! Form::text('search[designation]')->raw()!!}</th>
        <th>{!! Form::text('search[mobile]')->raw()!!}</th>
        <th>{!! Form::select('search[status]')->options(trans('user::user.options.status'))->raw()!!}</th>
       
    </thead>
</table>
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
    $("#dob").datetimepicker({
        timepicker:false,
        format:'Y-m-d',
    });
    app.load('#user-user-entry', '{!!trans_url('admin/user/user/0')!!}');
    oTable = $('#user-user-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/user/user') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#user-user-list .search_bar input, #user-user-list .search_bar select').each(
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
            {data :'email'},          
            {data :'designation'},
            {data :'mobile'},           
            {data :'status'},

        ],
        "pageLength": 25
    });

    $('#user-user-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#user-user-list').DataTable().row( this ).data();

        $('#user-user-entry').load('{!!trans_url('admin/user/user')!!}' + '/' + d.id);
    });

    $("#user-user-list .search_bar input, #user-user-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
    $("#user-user-list .search_bar select, #updated_at , #created_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

