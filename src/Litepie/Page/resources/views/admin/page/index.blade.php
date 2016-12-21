@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('page::page.name') !!} <small> {!! trans('app.manage') !!} {!! trans('page::page.names') !!}</small>
@stop

@section('title')
{!! trans('page::page.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('page::page.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='page-page-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<div class="table-responsive clearfix">
<table id="page-page-list" class="table table-striped data-table">
    <thead  class="list_head">
        <th>{!! trans('page::page.label.name')!!}</th>
        <th>{!! trans('page::page.label.title')!!}</th>
        <th>{!! trans('page::page.label.heading')!!}</th>
        <th>{!! trans('page::page.label.slug')!!}</th>
        <th>{!! trans('page::page.label.order')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th>{!! Form::text('search[title]')->raw()!!}</th>
        <th>{!! Form::text('search[heading]')->raw()!!}</th>
        <th>{!! Form::text('search[slug]')->raw()!!}</th>
        <th>{!! Form::text('search[order]')->raw()!!}</th>
    </thead>
</table>
</div>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#page-page-entry', '{!!trans_url('admin/page/page/0')!!}');
    oTable = $('#page-page-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/page/page') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#page-page-list .search_bar input, #page-page-list .search_bar select').each(
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
            {data :'title'},
            {data :'heading'},

            {data :'slug'},
            {data :'order'}
        ],
        "pageLength": 25
    });

    $('#page-page-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#page-page-list').DataTable().row( this ).data();

        $('#page-page-entry').load('{!!trans_url('admin/page/page')!!}' + '/' + d.id);

    });
    $("#page-page-list .search_bar input, #page-page-list .search_bar select").on('keyup select', function (e) {
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
