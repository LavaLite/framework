    {!!Form::vertical_open()
        ->id('task-task-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/task/task/'. $task->getRouteKey()))!!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Task</h4>
    </div>
    <div class="modal-body" style="min-height:430px; !important">
     @include('task::admin.task.partial.entry')
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-xs" data-action='UPDATE' data-dismiss="modal" data-form='#task-task-edit'  data-load-to='#{!!$task["status"]!!}_list' id="save-task"><i class="fa fa-floppy-o"></i> Save</button>
        <button type="button" class="btn btn-default btn-xs" id="btn-close"><i class="fa fa-times"></i>Close</button>
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