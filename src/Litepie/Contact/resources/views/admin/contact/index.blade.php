@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('contact::contact.name') !!} <small> {!! trans('app.manage') !!} {!! trans('contact::contact.names') !!}</small>
@stop

@section('title')
{!! trans('contact::contact.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('contact::contact.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='contact-contact-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="contact-contact-list" class="table table-stripedLitepieSERTRAITSSER AS USERMODEL data-table">
    <thead  class="list_head">
        <th>{!! trans('contact::contact.label.name')!!}</th>
        <th>{!! trans('contact::contact.label.phone')!!}</th>
        <th>{!! trans('contact::contact.label.mobile')!!}</th>
        <th>{!! trans('contact::contact.label.email')!!}</th>
        <th>{!! trans('contact::contact.label.website')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[name]')->raw()!!}</th>
        <th>{!! Form::text('search[phone]')->raw()!!}</th>
        <th>{!! Form::text('search[mobile]')->raw()!!}</th>
        <th>{!! Form::text('search[email]')->raw()!!}</th>
        <th>{!! Form::text('search[website]')->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#contact-contact-entry', '{!!trans_url('admin/contact/contact/0')!!}');
    oTable = $('#contact-contact-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/contact/contact') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#contact-contact-list .search_bar input, #contact-contact-list .search_bar select').each(
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
                    {data :'phone'},
                    {data :'mobile'},
                    {data :'email'},
                    {data :'website'},
        ],
        "pageLength": 25
    });

    $('#contact-contact-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#contact-contact-list').DataTable().row( this ).data();

        $('#contact-contact-entry').load('{!!trans_url('admin/contact/contact')!!}' + '/' + d.id);
    });

    $("#contact-contact-list .search_bar input, #contact-contact-list .search_bar select").on('keyup select', function (e) {
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
