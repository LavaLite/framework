<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-12 title-main">
                                <i class="pe-7s-right-arrow"></i>
                                <h4 class="title">To - Do</h4>
                                <p class="sub-title">Drag task between list</p>
                            </div>
                        </div>
                    </div>
                    <div class="content pn">
                        {!!Form::vertical_open()
                        ->id('task-task-create')
                        ->method('POST')
                        ->files('true')
                        ->enctype('multipart/form-data')
                        ->addClass('add-task-form')
                        ->action(guard_url('/task/task'))!!}
                        {!!Form::token()!!}
                            <div class="form-group form-danger mn is-empty">
                                <input type="hidden" name="status" value="to_do" placeholder="Add new task." class="input input-sm form-control">
                                <input type="text" name="task" placeholder="Add new task"  class="input form-control" required="required">
                            </div>
                            <button type="submit" class="btn btn-icon btn-round btn-danger btn-raised search-btn" data-action='CREATE' data-form='#task-task-create'  data-load-to='#to_do_list'><i class="fa fa-plus-circle"></i></button>
                        {!! Form::close() !!}  
                        <div class="task-list to-do" id="to_do_list">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header with-sub" data-background-color="orange">
                        <div class="row">
                            <div class="col-sm-12 title-main">
                                <i class="pe-7s-shuffle"></i>
                                <h4 class="title">In Progress</h4>
                                <p class="sub-title">Drag task between list</p>
                            </div>
                        </div>
                    </div>
                    <div class="content pn mt10">
                        <div class="task-list in-progress" id="in_progress_list">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header with-sub" data-background-color="green">
                        <div class="row">
                            <div class="col-sm-12 title-main">
                                <i class="pe-7s-check"></i>
                                <h4 class="title">Completed</h4>
                                <p class="sub-title">Drag task between list</p>
                            </div>
                        </div>
                    </div>
                    <div class="content pn mt10">
                        <div class="task-list completed" id="completed_list">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-task">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#to_do_list").load('{{guard_url('task/task/status?search[status]=to_do')}}');
        $("#in_progress_list").load('{{guard_url('task/task/status?search[status]=in_progress')}}');
        $("#completed_list").load('{{guard_url('task/task/status?search[status]=completed')}}');
    });
</script>
<style>
    .card .content {
        min-height: 580px;
    }
    .sortable-list {
        min-height: 350px;
    }
</style>

