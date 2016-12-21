@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('block::block.name') !!} <small> {!! trans('app.manage') !!} {!! trans('block::block.names') !!}</small>
@stop

@section('title')
{!! trans('block::block.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('block::block.names') !!}</li>
</ol>
@stop

@section('entry')
<div  id='block-block-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="block-block-list" class="table table-stripedLitepieSERTRAITSSER AS USERMODEL data-table">
    <thead  class="list_head">
        <th>{!! trans('block::block.label.category_id')!!}</th>
        <th>{!! trans('block::block.label.name')!!}</th>
        <th>{!! trans('block::block.label.status')!!}</th>
      

    </thead>
    <thead  class="search_bar">
        <th>{!! Form::select('search[category_id]')
                ->options(['' => 'All'] + Block::selectCategories())
                ->raw()!!}</th>
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
    app.load('#block-block-entry', '{!!trans_url('admin/block/block/0')!!}');
    oTable = $('#block-block-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/block/block') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#block-block-list .search_bar input, #block-block-list .search_bar select').each(
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
            {data :'category_id'},
                    {data :'name'},
                   {data :'status'},

        ],
        "pageLength": 25
    });

    $('#block-block-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#block-block-list').DataTable().row( this ).data();

        $('#block-block-entry').load('{!!trans_url('admin/block/block')!!}' + '/' + d.id);
    });

    $("#block-block-list .search_bar input, #block-block-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
    $("#block-block-list .search_bar select, #posted_on").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop
