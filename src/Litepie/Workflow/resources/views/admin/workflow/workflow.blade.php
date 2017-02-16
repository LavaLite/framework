
<table id="workflow-workflow-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>Name</th>
        <th>Module</th>
        <th>{!! trans('workflow::workflow.label.action')!!}</th>
        <th>{!! trans('workflow::workflow.label.status')!!}</th>
        <th>Performed by</th>
        <th>{!! trans('workflow::workflow.label.created_at')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('search[workflowable]')->raw()!!}</th>
        <th>{!! Form::text('search[workflowable_type]')->raw()!!}</th>
        <th>{!! Form::text('search[action]')->raw()!!}</th>
        <th>{!! Form::select('search[status]')-> options(['' => 'All'] + trans('workflow::workflow.options.status'))->raw()!!}</th>
        <th>{!! Form::text('search[performable_type]')->raw()!!}</th>
        <th>{!! Form::date('search[created_at]')->raw()!!}</th>
    </thead>
</table>

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
});
</script>