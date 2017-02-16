<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs danger">
        <li class="active"><a href="#workflows-tab" data-toggle="tab">Workflows</a></li>
        <li><a href="#revisions-tab" data-toggle="tab">Revisions</a></li>
    </ul>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="workflows-tab">
            <table id="workflowable-list" class="table table-striped  data-table" width="100%">
                <thead class="list_head">
                    <th>{!! trans('workflow::workflow.label.action')!!}</th>
                    <th>{!! trans('workflow::workflow.label.status')!!}</th>
                    <th>Performed by</th>
                    <th>Comments</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    <?php
                        $status = ['completed' => 'label label-success', 'pending' => 'label label-warning', 'cancelled' => 'label label-danger'];
                    ?>
                    @forelse($workflows as $key => $value)
                    <tr>
                        <td>{!! @$value->action !!}</td>
                        <td><label class="{{@$status[$value->status]}}">{!! @$value->status !!}</label></td>
                        <td>{!! @$value->performable->name !!}</td>            
                        <td>
                            @if(!empty($value->data) && $value->status == 'completed')
                            <a href='#' class='text-danger valueModal' data-id='{{$value->id}}'><input type='hidden' name='workflow-data{{$value->id}}' value='{{json_encode($value->data)}}'><i class='fa fa-file-text'></i></a>
                            @else
                            ---
                            @endif
                        </td>            
                        <td>{!! format_date_time($value->created_at) !!}</td>            
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Nothing to display...</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="revisions-tab">
            <table id="revision-list" class="table table-striped  data-table" width="100%">
                <thead  class="list_head">
                    <th>User Name</th>
                    <th>Field</th>
                    <th>Old Value</th>  
                    <th>New Value</th>
                    <th>Updated</th>
                </thead>
                <tbody>
                    @forelse($revisions as $key => $value)
                    <tr>
                        <td>{!! @$value->user->name !!}</td>
                        <td><strong>{!! trans(@$label.@$value->field) !!}</strong>({!!@$value->field !!})</td>
                        <td>{!! @$value->old_value !!}</td>
                        <td>{!! @$value->new_value !!}</td>            
                        <td>{!! date("d M, Y h:i A", strtotime($value->created_at)) !!}</td>            
                    </tr>
                    @empty
                    <tr>
                        <td>Nothing to display...</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="valueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #dd4b39;color: #fff;">
            <button type="button" class="close btn-close-valueModal" >&times;</button>
            <h3 class="modal-title">Workflow Values</h3>
        </div>
        <div class="modal-body">
            <div class='col-md-12 show-data'>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-close-valueModal">Close</button>
        </div>

    </div>          
  </div>
</div>
<style type="text/css">
    .modal-body{
        max-height: 625px !important;
        overflow: auto !important;
    }
    select.input-sm {
        line-height: 8px;
    }
</style>

<script type="text/javascript">
$(document).ready(function(){
   $('#workflowable-list, #revision-list').dataTable({
        "order": [[ 4, "asc" ]]
    });
   $(document).on('click','.valueModal', function (e) {
        e.preventDefault();
        var id      = $(this).data('id');
        var data    = $("input[name='workflow-data"+id+"']").val();
        $("#valueModal .show-data").html('');
        $.each( $.parseJSON(data), function( key, value ) {
            $("#valueModal .show-data").append("<h5><b>"+key+"</b></h5><p class='remote'>"+value+"</p>");
        });
        $("#valueModal").modal('show');
    });

    $(document).on('click','.btn-close-valueModal', function (e) {
        $("#valueModal").modal('hide');
    });

});
</script>