
@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('news::news.name') !!} <small> {!! trans('app.manage') !!} {!! trans('news::news.names') !!}</small>
@stop

@section('title')
{!! trans('news::news.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('news::news.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='news-news-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="news-news-list" class="table table-striped  data-table">
    <thead  class="list_head">
        <th>{!! trans('news::news.label.title')!!}</th>
        <th>{!! trans('news::news.label.status')!!}</th>
        <th>{!! trans('user::team.label.created_at')!!}</th>
        <th>{!! trans('user::team.label.updated_at')!!}</th>
    </thead>
     <thead  class="search_bar">
        <th>{!! Form::text('search[title]')->raw()!!}</th>
        <th>{!! Form::select('search[status]')
                ->options(['' => 'All'] + trans('news::news.options.status'))
                ->raw()!!}
        </th>
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
    app.load('#news-news-entry', '{!!URL::to('admin/news/news/0')!!}');
    oTable = $('#news-news-list').dataTable( {
         "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/news/news') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#news-news-list .search_bar input, #news-news-list .search_bar select').each(
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
            {data :'title'},
            {data :'status'},
            {data :'created_at'},
            {data :'updated_at'},
        ],
        "pageLength": 50
    });

    $('#news-news-list tbody').on( 'click', 'tr', function () {

        if ($(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var d = $('#news-news-list').DataTable().row( this ).data();

        $('#news-news-entry').load('{!!URL::to('admin/news/news')!!}' + '/' + d.id);

    });
     $("#news-news-list .search_bar input").on('keyup select', function (e) {
        e.preventDefault();
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
     $("#news-news-list .search_bar select, #creaed_at, #updated_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

