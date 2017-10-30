<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o"></i> {!! trans('roles::permission.name') !!} <small> {!! trans('app.manage') !!} {!! trans('roles::permission.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('/') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('roles::permission.names') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div id='roles-permission-entry'>
    </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                    <li class="{!!(request('status') == '')?'active':'';!!}"><a href="{!!guard_url('roles/permission')!!}">{!! trans('roles::permission.names') !!}</a></li>
            </ul>
            <div class="tab-content">
                <table id="roles-permission-list" class="table table-striped data-table">
                    <thead class="list_head">
                        <th>{!! trans('roles::permission.label.name')!!}</th>
                    <th>{!! trans('roles::permission.label.slug')!!}</th>
                    <th>{!! trans('roles::permission.label.created_at')!!}</th>
                    <th>{!! trans('roles::permission.label.updated_at')!!}</th>
                    </thead>
                    <thead  class="search_bar">
                        <th>{!! Form::text('search[name]')->raw()!!}</th>
                    <th>{!! Form::text('date[slug]')->raw()!!}</th>
                    <th>{!! Form::text('date[created_at]')->raw()!!}</th>
                    <th>{!! Form::text('date[updated_at]')->raw()!!}</th>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#roles-permission-entry', '{!!guard_url('roles/permission/0')!!}');
    oTable = $('#roles-permission-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! guard_url('roles/permission') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#roles-permission-list .search_bar input, #roles-permission-list .search_bar select').each(
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
            {data :'slug'},
            {data :'created_at'},
            {data :'updated_at'},
        ],
        "pageLength": 25
    });

    $('#roles-permission-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#roles-permission-list').DataTable().row( this ).data();

        $('#roles-permission-entry').load('{!!guard_url('roles/permission')!!}' + '/' + d.id);                                                           
    });

    $("#roles-permission-list .search_bar input, #roles-permission-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
});
</script>