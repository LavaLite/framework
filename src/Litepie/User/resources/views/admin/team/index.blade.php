@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('user::team.name') !!} <small> {!! trans('app.manage') !!} {!! trans('user::team.names') !!}</small>
@stop

@section('title')
{!! trans('user::team.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('user::team.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='user-team-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="user-team-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>{!! trans('user::team.label.name')!!}</th>
        <th>{!! trans('user::team.label.created_at')!!}</th>
        <th>{!! trans('user::team.label.updated_at')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th>{!! Form::text('search[created_at]')->id('created_at')->raw()!!}</th>
        <th>{!! Form::text('search[updated_at]')->id('updated_at')->raw()!!}</th>
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
    app.load('#user-team-entry', '{!!trans_url('admin/user/team/0')!!}');
    oTable = $('#user-team-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/user/team') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#user-team-list .search_bar input, #user-team-list .search_bar select').each(
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
            {data :'created_at'},
            {data :'updated_at'},

        ],
        "pageLength": 25
    });

    $('#user-team-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#user-team-list').DataTable().row( this ).data();

        $('#user-team-entry').load('{!!trans_url('admin/user/team')!!}' + '/' + d.id);
    });

    $("#user-team-list .search_bar input, #user-team-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
    $("#user-team-list .search_bar select, #updated_at , #created_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

