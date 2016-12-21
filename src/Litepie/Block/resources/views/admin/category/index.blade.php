@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('block::category.name') !!} <small> {!! trans('app.manage') !!} {!! trans('block::category.names') !!}</small>
@stop

@section('title')
{!! trans('block::category.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('block::category.names') !!}</li>
</ol>
@stop

@section('entry')
<div  id='block-category-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="block-category-list" class="table table-stripedLitepieSERTRAITSSER AS USERMODEL data-table">
    <thead  class="list_head">
        <th>{!! trans('block::category.label.name')!!}</th>
        <th>{!! trans('block::category.label.status')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th>{!! Form::select('search[status]')
                ->options(['' => 'All', 'Hide' => 'Hide','Show' => 'Show'])
                ->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#block-category-entry', '{!!trans_url('admin/block/category/0')!!}');
    oTable = $('#block-category-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/block/category') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#block-category-list .search_bar input, #block-category-list .search_bar select').each(
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
                    {data :'status'},
        ],
        "pageLength": 25
    });

    $('#block-category-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#block-category-list').DataTable().row( this ).data();

        $('#block-category-entry').load('{!!trans_url('admin/block/category')!!}' + '/' + d.id);
    });

    $("#block-category-list .search_bar input, #block-category-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
    $("#block-category-list .search_bar select").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

