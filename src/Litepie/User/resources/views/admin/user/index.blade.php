<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o"></i> {!! trans('user::user.name') !!} <small> {!! trans('app.manage') !!} {!! trans('user::user.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('/') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('user::user.names') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div id='user-user-entry'>
    </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                    <li class="{!!(request('status') == '')?'active':'';!!}"><a href="{!!guard_url('user/user')!!}">{!! trans('user::user.names') !!}</a></li>
                    <li class="pull-right">
                    <span class="actions">
                    <!--   
                    <a  class="btn btn-xs btn-purple"  href="{!!guard_url('user/user/reports')!!}"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-sm hidden-xs"> Reports</span></a>
                    @include('user::admin.user.partial.actions')
                    -->
                    @include('user::admin.user.partial.filter')
                    @include('user::admin.user.partial.column')
                    </span> 
                </li>
            </ul>
            <div class="tab-content">
                <table id="user-user-list" class="table table-striped data-table">
                    <thead class="list_head">
                        <th style="text-align: right;" width="1%"><a class="btn-reset-filter" href="#Reset" style="display:none; color:#fff;"><i class="fa fa-filter"></i></a> <input type="checkbox" id="user-user-check-all"></th>
                        <th>{!! trans('user::user.label.name')!!}</th>
                    <th>{!! trans('user::user.label.email')!!}</th>
                    <th>{!! trans('user::user.label.sex')!!}</th>
                    <th>{!! trans('user::user.label.dob')!!}</th>
                    <th>{!! trans('user::user.label.designation')!!}</th>
                    <th>{!! trans('user::user.label.mobile')!!}</th>
                    <th>{!! trans('user::user.label.phone')!!}</th>
                    <th>{!! trans('user::user.label.street')!!}</th>
                    <th>{!! trans('user::user.label.city')!!}</th>
                    <th>{!! trans('user::user.label.district')!!}</th>
                    <th>{!! trans('user::user.label.state')!!}</th>
                    <th>{!! trans('user::user.label.country')!!}</th>
                    <th>{!! trans('user::user.label.web')!!}</th>
                    <th>{!! trans('user::user.label.status')!!}</th>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

var oTable;
var oSearch;
$(document).ready(function(){
    app.load('#user-user-entry', '{!!guard_url('user/user/0')!!}');
    oTable = $('#user-user-list').dataTable( {
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
        "sAjaxSource": '{!! guard_url('user/user') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $.each(oSearch, function(key, val){
                aoData.push( { 'name' : key, 'value' : val } );
            });
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
            {data :'id'},
            {data :'name'},
            {data :'email'},
            {data :'sex'},
            {data :'dob'},
            {data :'designation'},
            {data :'mobile'},
            {data :'phone'},
            {data :'street'},
            {data :'city'},
            {data :'district'},
            {data :'state'},
            {data :'country'},
            {data :'web'},
            {data :'status'},
        ],
        "pageLength": 25
    });

    $('#user-user-list tbody').on( 'click', 'tr td:not(:first-child)', function (e) {
        e.preventDefault();

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        var d = $('#user-user-list').DataTable().row( this ).data();
        $('#user-user-entry').load('{!!guard_url('user/user')!!}' + '/' + d.id);
    });

    $('#user-user-list tbody').on( 'change', "input[name^='id[]']", function (e) {
        e.preventDefault();

        aIds = [];
        $(".child").remove();
        $(this).parent().parent().removeClass('parent'); 
        $("input[name^='id[]']:checked").each(function(){
            aIds.push($(this).val());
        });
    });

    $("#user-user-check-all").on( 'change', function (e) {
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
        $('#user-user-list .reset_filter').css('display', 'none');

    });


    // Add event listener for opening and closing details
    $('#user-user-list tbody').on('click', 'td.details-control', function (e) {
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