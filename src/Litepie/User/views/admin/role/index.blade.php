@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('user.role.name') !!} <small> {!! trans('cms.manage') !!} {!! trans('user.role.names') !!}</small>
@stop

@section('title')
{!! trans('user.role.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
    <li class="active">{!! trans('user.role.names') !!}</li>
</ol>
@stop

@section('entry')
<div class="box box-warning" id='user-role-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="user-role-list" class="table table-striped table-bordered">
    <thead>
        <th>{!! trans('user.role.label.name')!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#user-role-entry', '{!!trans_url('admin/user/role/0')!!}');
    oTable = $('#user-role-list').dataTable( {
        "ajax": '{!! trans_url('/admin/user/role') !!}',
        "columns": [
            {data :'name'},
        ],
        "pageLength": 50
    });

    $('#user-role-list tbody').on( 'click', 'tr', function () {

        if ($(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var d = $('#user-role-list').DataTable().row( this ).data();

        $('#user-role-entry').load('{!!trans_url('admin/user/role')!!}' + '/' + d.id);

    });
});
</script>
@stop

@section('style')
@stop
