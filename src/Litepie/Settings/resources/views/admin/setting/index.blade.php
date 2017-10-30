<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o"></i> {!! trans('settings::setting.name') !!} <small> {!! trans('app.manage') !!} {!! trans('settings::setting.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('/') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('settings::setting.names') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div id='settings-setting-entry'>
    </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                    <li class="{!!(request('status') == '')?'active':'';!!}"><a href="{!!guard_url('settings/setting')!!}">{!! trans('settings::setting.names') !!}</a></li>

            </ul>
            <div class="tab-content">
                <table id="settings-setting-list" class="table table-striped data-table">
                    <thead class="list_head">
                        <th>{!! trans('settings::setting.label.key')!!}</th>
                    <th>{!! trans('settings::setting.label.package')!!}</th>
                    <th>{!! trans('settings::setting.label.module')!!}</th>
                    <th>{!! trans('settings::setting.label.name')!!}</th>
                    <th>{!! trans('settings::setting.label.value')!!}</th>
                    <th>{!! trans('settings::setting.label.file')!!}</th>
                    <th>{!! trans('settings::setting.label.control')!!}</th>
                    <th>{!! trans('settings::setting.label.type')!!}</th>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#settings-setting-entry', '{!!guard_url('settings/setting/0')!!}');
    oTable = $('#settings-setting-list').dataTable( {
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
        "sAjaxSource": '{!! guard_url('settings/setting') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#settings-setting-list .search_bar input, #settings-setting-list .search_bar select').each(
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
            {data :'key'},
            {data :'package'},
            {data :'module'},
            {data :'name'},
            {data :'value'},
            {data :'file'},
            {data :'control'},
            {data :'type'},
        ],
        "pageLength": 25
    });

    $('#settings-setting-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#settings-setting-list').DataTable().row( this ).data();

        $('#settings-setting-entry').load('{!!guard_url('settings/setting')!!}' + '/' + d.id);                                                           
    });

    $("#settings-setting-list .search_bar input, #settings-setting-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
});
</script>