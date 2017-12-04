<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-flag-o"></i> {!! trans('task::task.name') !!} <small> {!! trans('app.manage') !!} {!! trans('task::task.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('task::task.names') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox box box-warning">
                    <div class="ibox-content">
                        <h3>To-do</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                        {!!Form::vertical_open()
                        ->id('create-task')
                        ->method('POST')
                        ->files('true')
                        ->enctype('multipart/form-data')
                        ->action(guard_url('task/task'))!!}
                        {!!Form::token()!!}
                        <div class="input-group">
                            <input type="hidden" name="new-status" value="to_do" placeholder="Add new task." class="input input-sm form-control">
                            <input type="text" name="new-task" placeholder="Add new task." class="input input-sm form-control" required="required">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-sm task-button" data-action='CREATE' data-form='#create-task'  data-load-to='#to_do_list'>Add Task</button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                        <div id="to_do_list">
                        </div>               
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox box box-primary">
                    <div class="ibox-content">
                        <h3>In Progress</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                        <div id="in_progress_list">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox box box-success">
                    <div class="ibox-content">
                        <h3>Completed</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                        <div id="completed_list">
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
    </section>
</div>

    <script>
        $(document).ready(function(){
            $("#to_do_list").load('{{trans_url('admin/task/task/status?search[status]=to_do')}}');
            $("#in_progress_list").load('{{trans_url('admin/task/task/status?search[status]=in_progress')}}');
            $("#completed_list").load('{{trans_url('admin/task/task/status?search[status]=completed')}}'); 
        });
    </script>


