<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o"></i> {!! trans('user::client.name', ['client' => $type]) !!} <small> {!! trans('app.manage') !!} {!! trans('user::client.names', ['client' => $type]) !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('/') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('user::client.names', ['client' => $type]) !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div id='user-client-entry'>
    </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                    <li class="{!!(request('status') == '')?'active':'';!!}"><a href="{!!guard_url('user/'.$type)!!}">{!! trans('user::client.names', ['client' => $type]) !!}</a></li>
                    <li class="{!!(request('status') == 'archive')?'active':'';!!}"><a href="{!!guard_url('user/client?status=archive')!!}">Archived</a></li>
                    <li class="{!!(request('status') == 'deleted')?'active':'';!!}"><a href="{!!guard_url('user/client?status=deleted')!!}">Trashed</a></li>
                    <li class="pull-right">
                    <span class="actions">
                    @include('user::admin.default.partial.filter')
                    @include('user::admin.default.partial.column')
                    </span> 
                </li>
            </ul>
            <div class="tab-content">
                <table id="user-client-list" class="table table-striped data-table">
                    <thead class="list_head">
                        <th style="text-align: right;" width="1%"><a class="btn-reset-filter" href="#Reset" style="display:none; color:#fff;"><i class="fa fa-filter"></i></a> <input type="checkbox" id="user-client-check-all"></th>
                        <th data-field="name">{!! trans('user::client.label.name')!!}</th>
                    <th data-field="email">{!! trans('user::client.label.email')!!}</th>
                    <th data-field="sex">{!! trans('user::client.label.sex')!!}</th>
                    <th data-field="dob">{!! trans('user::client.label.dob')!!}</th>
                    <th data-field="mobile">{!! trans('user::client.label.mobile')!!}</th>
                    <th data-field="phone">{!! trans('user::client.label.phone')!!}</th>
                    <th data-field="address">{!! trans('user::client.label.address')!!}</th>
                    <th data-field="street">{!! trans('user::client.label.street')!!}</th>
                    <th data-field="city">{!! trans('user::client.label.city')!!}</th>
                    <th data-field="district">{!! trans('user::client.label.district')!!}</th>
                    <th data-field="state">{!! trans('user::client.label.state')!!}</th>
                    <th data-field="country">{!! trans('user::client.label.country')!!}</th>
                    <th data-field="photo">{!! trans('user::client.label.photo')!!}</th>
                    <th data-field="web">{!! trans('user::client.label.web')!!}</th>
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
    app.load('#user-client-entry', '{!!guard_url('user/' . $type . '/0')!!}');
    oTable = $('#user-client-list').dataTable( {
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
        "sAjaxSource": '{!! guard_url('user/'.$type) !!}',
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
            {data :'mobile'},
            {data :'phone'},
            {data :'address'},
            {data :'street'},
            {data :'city'},
            {data :'district'},
            {data :'state'},
            {data :'country'},
            {data :'photo'},
            {data :'web'},
        ],
        "pageLength": 25
    });

    $('#user-client-list tbody').on( 'click', 'tr td:not(:first-child)', function (e) {
        e.preventDefault();

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        var d = $('#user-client-list').DataTable().row( this ).data();
        $('#user-client-entry').load('{!!guard_url('user/'.$type)!!}' + '/' + d.id);
    });

    $('#user-client-list tbody').on( 'change', "input[name^='id[]']", function (e) {
        e.preventDefault();

        aIds = [];
        $(".child").remove();
        $(this).parent().parent().removeClass('parent'); 
        $("input[name^='id[]']:checked").each(function(){
            aIds.push($(this).val());
        });
    });

    $("#user-client-check-all").on( 'change', function (e) {
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
        $('#user-client-list .reset_filter').css('display', 'none');

    });


    // Add event listener for opening and closing details
    $('#user-client-list tbody').on('click', 'td.details-control', function (e) {
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