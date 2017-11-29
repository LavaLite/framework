{!!Form::vertical_open()
    ->id('task-task-edit')
    ->method('PUT')
    ->enctype('multipart/form-data')
    ->action(guard_url('task/task/'. $task->getRouteKey()))!!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Edit Task</h4>
</div>
<div class="modal-body" style="min-height:430px; !important">
    <div class="row">
        @include('task::user.task.partial.entry')
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-danger btn-raised btn btn-sm" data-action='UPDATE' data-dismiss="modal" data-form='#task-task-edit'  data-load-to='#{!!$task["status"]!!}_list' id="save-task"><i class="fa fa-floppy-o"></i> Save<div class="ripple-container"></div></button>
    <button type="button" class="btn-default btn-raised btn btn-sm" id="btn-close">Close <div class="ripple-container"></button>
</div>
{!! Form::close() !!}

<script type="text/javascript">
    $("#btn-close").click(function(){
        $('#modal-task').modal('hide');
    });
</script>
<style type="text/css">
    .modal-footer{
        padding:15px !important;
    }
    .form-group {
         padding-bottom: 0px !important; 
         margin: 0px !important; 
    }
</style>

