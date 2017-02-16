@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('workflow::workflow.name') !!} <small> {!! trans('app.manage') !!} {!! trans('workflow::workflow.names') !!}</small>
@stop

@section('title')
{!! trans('workflow::workflow.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('workflow::workflow.names') !!}</li>
</ol>
@stop

@section('entry')
<!-- <div id='workflow-workflow-entry'>
</div> -->
@stop

@section('tools')
@stop

@section('content')
<div class="modal fade" id="valueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #dd4b39;color: #fff;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h3 class="modal-title">Workflow Values</h3>
        </div>
        <div class="modal-body" style="min-height:220px;">
            <div class='col-md-12 show-data'>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

    </div>          
  </div>
</div>

<table id="workflow-workflow-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>Name</th>
        <th>Module</th>
        <th>{!! trans('workflow::workflow.label.action')!!}</th>
        <th>{!! trans('workflow::workflow.label.status')!!}</th>
        <th>Performed by</th>
        <th>{!! trans('workflow::workflow.label.data')!!}</th>
        <th>{!! trans('workflow::workflow.label.created_at')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[workflowable]')->raw()!!}</th>
        <th>{!! Form::text('search[workflowable_type]')->raw()!!}</th>
        <th>{!! Form::text('search[action]')->raw()!!}</th>
        <th>{!! Form::select('search[status]')-> options(['' => 'All'] + trans('workflow::workflow.options.status'))->raw()!!}</th>
        <th>{!! Form::text('search[performable_type]')->raw()!!}</th>
        <th>&nbsp;</th>
        <th>{!! Form::date('search[created_at]')->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    //app.load('#workflow-workflow-entry', '{!!trans_url('admin/workflow/workflow/0')!!}');
    oTable = $('#workflow-workflow-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/workflow/workflow') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#workflow-workflow-list .search_bar input, #workflow-workflow-list .search_bar select').each(
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
            {data :'workflowable'},
            {data :'module'},
            {data :'action'},
            {data :'status'},
            {data :'performable'},
            {data :'data'},
            {data :'created_at'},
        ],
        "pageLength": 10,
        "order": [[ 5, "desc" ]]

    });

    /*$('#workflow-workflow-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#workflow-workflow-list').DataTable().row( this ).data();

        $('#workflow-workflow-entry').load('{!!trans_url('admin/workflow/workflow')!!}' + '/' + d.id);
    });*/

    $("#workflow-workflow-list .search_bar input, #workflow-workflow-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
    $("#workflow-workflow-list .search_bar input[type='date'], #workflow-workflow-list .search_bar select").on('change select', function (e) {
        e.preventDefault();
        oTable.api().draw();
    });
    $(document).on('click','.valueModal', function (e) {
        e.preventDefault();
        var id      = $(this).data('id');
        var data    = $("input[name='workflow-data"+id+"']").val();
        var comment = $(this).data('comment');
        $("#valueModal .show-data").html('');
        $.each( $.parseJSON(data), function( key, value ) {
            $("#valueModal .show-data").append("<h5><b>"+key+"</b></h5><p class='remote'>"+value+"</p>");
        });
        $("#valueModal .show-data").append("<h5><b>Comments</b></h5><p class='remote'>"+comment+"</p>");

        $("#valueModal").modal('show');
    });
});
</script>
@stop

@section('style')
@stop

