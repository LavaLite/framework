<style type="text/css">
    .widget-user .widget-user-header {
        height: auto !important;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1> {!! trans('master::master.name') !!} <small>{!! trans('master::master.masters.'.$type) !!}</small> </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!}</a></li>
            <li class="active"><a href="/admin/masters">{!! trans('master::master.names') !!}</a></li>
            <li class="active">{!! trans('master::master.masters.'.$type) !!}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    @include('master::menu', ['group'=> $groups[$group], 'key' => $group])
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div id='masters-entry'>
                </div>
                <div class="nav-tabs-custom">
                    @include('master::' . config("master.masters.$type.view", 'master.default'))
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
var module_link = "{{guard_url('master/master')}}";
var oTable;
var oSearch;
$(document).ready(function(){
    app.load('#masters-entry', '{!!guard_url("masters/{$group}/{$type}/master/0")!!}');
    oTable = $('#masters-list').dataTable( {
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
        "sAjaxSource": '{!! guard_url("masters/{$group}/{$type}/master") !!}',
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
            {data :'slug'},
            {data :'status'},
        ],
        "pageLength": 25
    });

    $('#masters-list tbody').on( 'click', 'tr td:not(:first-child)', function (e) {
        e.preventDefault();

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        var d = $('#masters-list').DataTable().row( this ).data();
        $('#masters-entry').load('{!!guard_url("masters/{$group}/{$type}/master")!!}' + '/' + d.id);
    });

    $('#masters-list tbody').on( 'change', "input[name^='id[]']", function (e) {
        e.preventDefault();

        aIds = [];
        $(".child").remove();
        $(this).parent().parent().removeClass('parent'); 
        $("input[name^='id[]']:checked").each(function(){
            aIds.push($(this).val());
        });
    });

    $("#masters-check-all").on( 'change', function (e) {
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
        $('#masters-list .reset_filter').css('display', 'none');

    });


    // Add event listener for opening and closing details
    $('#masters-list tbody').on('click', 'td.details-control', function (e) {
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