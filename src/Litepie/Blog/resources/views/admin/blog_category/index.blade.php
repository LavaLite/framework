@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('blog::blog_category.name') !!} <small> {!! trans('cms.manage') !!} {!! trans('blog::blog_category.names') !!}</small>
@stop

@section('title')
{!! trans('blog::blog_category.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
    <li class="active">{!! trans('blog::blog_category.names') !!}</li>
</ol>
@stop

@section('entry')
<div class="box box-warning" id='blog-blog_category-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="blog-blog_category-list" class="table table-stripedLitepieSERTRAITSSER AS USERMODEL data-table">
 
     <thead  class="list_head">
        <th>{!! trans('blog::blog_category.label.name')!!}</th>
        <th>{!! trans('blog::blog_category.label.status')!!}</th>
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
    app.load('#blog-blog_category-entry', '{!!trans_url('admin/blog/blog_category/0')!!}');
    oTable = $('#blog-blog_category-list').dataTable( {
          "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/blog/blog_category') !!}',
       "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#blog-blog_category-list .search_bar input, #blog-blog_category-list .search_bar select').each(
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
        "pageLength": 50
    });

    $('#blog-blog_category-list tbody').on( 'click', 'tr', function () {

        if ($(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var d = $('#blog-blog_category-list').DataTable().row( this ).data();

        $('#blog-blog_category-entry').load('{!!trans_url('admin/blog/blog_category')!!}' + '/' + d.id);

    });


    $("#blog-blog_category-list .search_bar input").on('keyup select', function (e) {
        e.preventDefault();
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
     $("#blog-blog_category-list .search_bar select").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

