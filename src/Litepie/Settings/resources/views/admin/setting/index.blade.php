@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('settings::setting.name') !!} <small> {!! trans('app.manage') !!} {!! trans('settings::setting.names') !!}</small>
@stop

@section('title')
{!! trans('settings::setting.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('settings::setting.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='settings-setting-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="settings-setting-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>{!! trans('settings::setting.label.skey')!!}</th>
        <th>{!! trans('settings::setting.label.name')!!}</th>
        <th>{!! trans('settings::setting.label.value')!!}</th>
        <th>{!! trans('settings::setting.label.type')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[skey]')->raw()!!}</th>
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th>{!! Form::text('search[value]')->raw()!!}</th>
        <th>{!! Form::text('search[type]')->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#settings-setting-entry', '{!!trans_url('admin/settings/setting/0')!!}');
    oTable = $('#settings-setting-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/settings/setting') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#settings-setting-list .search_bar input, #settings-setting-list .search_bar select').each(
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
            {data :'skey'},
            {data :'name'},
            {data :'value'},
            {data :'type'},
        ],
        "pageLength": 25
    });

    $('#settings-setting-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#settings-setting-list').DataTable().row( this ).data();

        $('#settings-setting-entry').load('{!!trans_url('admin/settings/setting')!!}' + '/' + d.id);
    });

    $("#settings-setting-list .search_bar input, #settings-setting-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
});
</script>
@stop

@section('style')
@stop
