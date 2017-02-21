@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> Notifications <small> {!! trans('app.manage') !!} Notifications</small>
@stop

@section('title')
Notifications
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">Notifications</li>
</ol>
@stop

@section('entry')
<div id='notification-notification-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="notification-notification-list" class="table table-striped  data-table">
    <thead  class="list_head">
        <th>Name</th>
        <th>Module</th>
        <th>Action</th>
        <th>Read</th>
        <th>Created</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th></th>
        <th>{!! Form::text('search[action]')->raw()!!}</th>
        <th>{!! Form::text('search[read_at]')->raw()!!}</th>
        <th>{!! Form::text('search[created_at]')->raw()!!}</th>
        
    </thead>
    

</table>
@stop

@section('script')
<script type="text/javascript">
var oTable;
$(document).ready(function(){

    app.load('#notification-notification-entry', '{!!URL::to('/admin/user/notification/0')!!}');
    oTable = $('#notification-notification-list').dataTable( {
         "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/user/notification') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#notification-notification-list .search_bar input, #notification-notification-list .search_bar select').each(
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
            {data :'type'},
            {data :'action'},
            {data :'read_at'},
            {data :'created_at'},
        ],
        "pageLength": 50
    });

    $('#notification-notification-list tbody').on( 'click', 'tr', function () {

        if ($(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var d = $('#notification-notification-list').DataTable().row( this ).data();

        $('#notification-notification-entry').load('{!!URL::to('/admin/user/notification')!!}' + '/' + d.id);

    });
     $("#notification-notification-list .search_bar input").on('keyup select', function (e) {
        e.preventDefault();
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
     $("#notification-notification-list .search_bar select, #creaed_at, #updated_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>      }
    });
     $("#notification-notification-list .search_bar select, #creaed_at, #updated_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
});
</script>
@stop

@section('style')
@stop

