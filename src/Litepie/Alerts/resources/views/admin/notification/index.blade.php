<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bell-o"></i> {!! trans('alerts::notification.name') !!} <small> {!! trans('app.manage') !!} {!! trans('alerts::notification.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('/') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('alerts::notification.names') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div id='alerts-notification-entry'>
    </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                    <li class="{!!(request('status') == '')?'active':'';!!}"><a href="{!!guard_url('alerts/notification')!!}">{!! trans('alerts::notification.names') !!}</a></li>
                    <li class="pull-right">
                    <span class="actions">   
                    @include('alerts::admin.notification.partial.filter')
                    @include('alerts::admin.notification.partial.column')
                    </span> 
                </li>
            </ul>
            <div class="tab-content">
                <table id="alerts-notification-list" class="table table-striped data-table">
                    <thead class="list_head">
                        <th style="text-align: right;" width="1%"><a class="reset_filter" href="#Reset" style="display:none; color:#fff;"><i class="fa fa-filter"></i></a> <input type="checkbox" id="alerts-notification-check-all"></th>
                        <th>{!! trans('alerts::notification.label.type')!!}</th>
                    <th>{!! trans('alerts::notification.label.notifiable_id')!!}</th>
                    <th>{!! trans('alerts::notification.label.notifiable_type')!!}</th>
                    <th>{!! trans('alerts::notification.label.data')!!}</th>
                    <th>{!! trans('alerts::notification.label.read_at')!!}</th>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#alerts-notification-entry', '{!!guard_url('alerts/notification/0')!!}');
    oTable = $('#alerts-notification-list').dataTable( {
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta){
                return '<input type="checkbox" name="id[]" value="' + data.id + '">';
            }
        }], 
        
        "responsive" : true,
        "order": [[1, 'asc']],
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! guard_url('alerts/notification') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#alerts-notification-list .search_bar input, #alerts-notification-list .search_bar select').each(
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
            {data :'type'},
            {data :'notifiable_id'},
            {data :'notifiable_type'},
            {data :'data'},
            {data :'read_at'},
        ],
        "pageLength": 25
    });

    $('#alerts-notification-list tbody').on( 'click', 'tr td:not(:first-child)', function (e) {
        e.preventDefault();

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        var d = $('#alerts-notification-list').DataTable().row( this ).data();
        $('#alerts-notification-entry').load('{!!guard_url('alerts/notification')!!}' + '/' + d.id);
    });

    $('#alerts-notification-list tbody').on( 'change', "input[name^='id[]']", function (e) {
        e.preventDefault();

        aIds = [];
        $(".child").remove();
        $(this).parent().parent().removeClass('parent'); 
        $("input[name^='id[]']:checked").each(function(){
            aIds.push($(this).val());
        });
    });

    $("#alerts-notification-check-all").on( 'change', function (e) {
        e.preventDefault();
        aIds = [];
        if ($(this).prop('checked')) {
            $("input[name^='id[]']").each(function(){
                $(this).prop('checked',true);
                aIds.push($(this).val());
            });

            return;
        }else{
            $("input[name^='id[]']").prop('checked',false);
        }
        
    });


    $(".reset_filter").click(function (e) {
        e.preventDefault();
        $("#form-search")[ 0 ].reset();
        $('#form-search input,#form-search select').each( function () {
          oTable.search( this.value ).draw();
        });
        $('#alerts-notification-list .reset_filter').css('display', 'none');

    });


    // Add event listener for opening and closing details
    $('#alerts-notification-list tbody').on('click', 'td.details-control', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

});
</script>