<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">                       
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class=" title">To-do</h3>
                                <p class="small"><i class="ion ion-arrow-move"></i> Drag task between list</p>   
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">                        
                            {!!Form::vertical_open()
                            ->id('task-task-create')
                            ->method('POST')
                            ->files('true')
                            ->enctype('multipart/form-data')
                            ->action(Trans::to($guard.'/task/task'))!!}
                            {!!Form::token()!!}
                            <div class="input-group">
                                <input type="hidden" name="status" value="to_do" placeholder="Add new task." class="input input-sm form-control">
                                <input type="text" name="task" placeholder="Add new task"  class="input form-control" required="required">
                                <span class="input-group-btn"  id="new-task">
                                    <button type="button" class="btn-danger btn-raised btn btn-sm" data-action='CREATE' data-form='#task-task-create'  data-load-to='#to_do_list'>Add Task<div class="ripple-container"></button>
                                </span>
                            </div>
                            {!! Form::close() !!}               
                        <div id="to_do_list">
                        </div> 
                    </div>
                </div>
            </div>   
            <div class="col-lg-4">
                <div class="card">
                    <div class="header with-sub" data-background-color="orange">                        
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class=" title">In Progress</h3>
                                <p class="small"><i class="ion ion-arrow-move"></i> Drag task between list</p>   
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <div id="in_progress_list">
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="header with-sub" data-background-color="green">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class=" title">Completed</h3>
                                <p class="small"><i class="ion ion-arrow-move"></i> Drag task between list</p>   
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <div id="completed_list">
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
        $("#to_do_list").load('{{URL::to($guard.'/task/status?search[status]=to_do')}}');
        $("#in_progress_list").load('{{URL::to($guard.'/task/status?search[status]=in_progress')}}');
        $("#completed_list").load('{{URL::to($guard.'/task/status?search[status]=completed')}}');
    });
</script>

