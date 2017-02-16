
@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('revision::revision.name') !!} <small> {!! trans('app.manage') !!} {!! trans('revision::revision.names') !!}</small>
@stop

@section('title')
{!! trans('revision::revision.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('revision::revision.names') !!}</li>
</ol>
@stop

@section('entry')
@stop

@section('tools')
@stop

@section('content')

<div class="modal fade" id="valueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #dd4b39;color: #fff;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h3 class="modal-title">Revision Values</h3>
        </div>
        <div class="modal-body" style="min-height:220px;">
            <div class='col-md-12'>
                {!! Form::textarea('old_value')
                -> label('Old Value')
                -> placeholder('Enter old value')
                -> disabled()!!}
            </div>
            <div class='col-md-12' style="margin-top:20px;">
                {!! Form::textarea('new_value')
                -> label('New Value')
                -> placeholder('Enter new value')
                -> disabled()!!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

    </div>          
  </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs primary">
            <li><a href="{{trans_url('admin/revision/activity')}}">Activities</a></li>
            <li class="active"><a href="#tab-revisions" data-toggle="tab">Revisions</a></li>
        </ul>
        <div class="tab-content">            
            <div class="tab-pane active" id="tab-revisions">
                <table id="revision-revision-list" class="table table-striped  data-table">
                    <thead  class="list_head">
                        <th width="20%">Field</th>
                        <th width="20%">Module</th>
                        <th width="15%">user</th>
                        <th width="15%">Values</th>
                        <th width="30%">Date</th>
                    </thead>
                     <thead  class="search_bar">
                        <th>{!! Form::text('search[field]')->raw()!!}</th>
                        <th>{!! Form::text('search[revision_type]')->raw()!!}</th>
                        <th>{!! Form::text('search[user_id]')->raw()!!}</th>
                        <th></th>
                        <th>{!! Form::text('search[created_at]')->id('created_at')->raw()!!}</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
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
    oTable = $('#revision-revision-list').dataTable( {
         "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/revision/revision') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#revision-revision-list .search_bar input, #revision-revision-list .search_bar select').each(
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
            {data :'field'},
            {data :'revision_type'},
            {data :'user_id'},
            {data :'values'},
            {data :'created_at'},
        ],
        "pageLength": 20
    });

    $('#revision-revision-list tbody').on( 'click', 'tr', function () {

        if ($(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var d = $('#revision-revision-list').DataTable().row( this ).data();

        $('#revision-revision-entry').load('{!!trans_url('admin/revision/revision')!!}' + '/' + d.id);

    });
     $("#revision-revision-list .search_bar input").on('keyup select', function (e) {
        e.preventDefault();
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
     $("#revision-revision-list .search_bar select, #creaed_at, #updated_at").on('change', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });

    $(document).on('click','.valueModal', function (e) {
        e.preventDefault();
        $("textarea[name='old_value']").html($(this).data('old'));
        $("textarea[name='new_value']").html($(this).data('new'));
        $("#valueModal").modal('show');
    });
});
</script>
@stop

@section('style')
@stop

