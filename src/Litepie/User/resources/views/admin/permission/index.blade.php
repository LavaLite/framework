@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('user::permission.name') !!} <small> {!! trans('app.manage') !!} {!! trans('user::permission.names') !!}</small>
@stop

@section('title')
{!! trans('user::permission.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('user::permission.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='user-permission-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="user-permission-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>{!! trans('user::permission.label.slug')!!}</th>
        <th>{!! trans('user::permission.label.name')!!}</th>
        <th>{!! trans('user::permission.label.created_at')!!}</th>
        <th>{!! trans('user::permission.label.updated_at')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[slug]')->raw()!!}</th>
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th>{!! Form::text('search[created_at]')->raw()!!}</th>
        <th>{!! Form::text('search[updated_at]')->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">
var oTable;
$(document).ready(function(){
    $("#created_at").pickadate({
        format: 'dd mmm, yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenSuffix: '',
        selectMonths: true,
        selectYears: true
    }).prop('type','text');
    $("#updated_at").pickadate({
        format: 'dd mmm, yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenSuffix: '',
        selectMonths: true,
        selectYears: true
    }).prop('type','text');
    app.load('#user-permission-entry', '{!!trans_url('admin/user/permission/0')!!}');
    oTable = $('#user-permission-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/user/permission') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#user-permission-list .search_bar input, #user-permission-list .search_bar select').each(
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
            {data :'slug'},
            {data :'name'},
            {data :'created_at'},
            {data :'updated_at'},

        ],
        "pageLength": 25
    });

    $('#user-permission-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#user-permission-list').DataTable().row( this ).data();

        $('#user-permission-entry').load('{!!trans_url('admin/user/permission')!!}' + '/' + d.id);
    });

    $("#user-permission-list .search_bar input, #user-permission-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
    $("#user-permission-list .search_bar select, #updated_at , #created_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

