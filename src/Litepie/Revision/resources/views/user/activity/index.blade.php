<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-8 title-main">
                                <i class="pe-7s-display2"></i>
                                <h4 class="title">Activity</h4>
                                <p class="sub-title">List of Activities</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-form">
                                    {!!Form::open()
                                   ->method('GET')
                                   ->class('form pn')
                                   ->action(trans_url($guard.'/revision/activity'))!!}
                                    <div class="form-group form-white mn">
                                      {!!Form::text('search')->type('text')->placeholder('Search')->raw()!!}
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-round btn-white btn-raised search-btn"><i class="fa fa-search"></i></button>
                                    {!! Form::close()!!}
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        @include('public::notifications')
                        <table class="table table-bigboy">
                            <thead>
                                <tr>
                                    <th width="30%">Revision Name</th>
                                    <th width="15%">Action</th>
                                    <th width="15%">Module</th>
                                    <th width="15%">user</th>
                                    <th width="15%">User Information</th>
                                    <th width="20%">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $class = ['Deleted' => 'danger', 'Created' => 'primary', 'Updated' => 'success'];
                                ?>
                                @forelse($activity as $content)
                                <tr>
                                    <td>
                                        <span class="word-inline">{{@$content['name']}}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{$class[@$content->action]}}">{{@$content['action']}}</span></a>
                                    </td>                                    
                                    <td>
                                        {{substr(strrchr(@$content['activity_type'], '\\'), 1)}}
                                    </td>
                                    <td>
                                        <span class="word-inline">{{@$content['user']['name']}}</span>
                                    </td>
                                    <td>
                                        <a href="#valueModal{{$content['id']}}" data-toggle="modal" class="text-danger"><i class="pe-7s-note2 pe-2x"></i></a>
                                        <div class="modal fade" id="valueModal{{$content['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close btn btn-danger btn-simple" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                                        <h3 class="modal-title">User Informations</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class='col-md-12'>
                                                            <?php $user_info = json_decode($content['user_info'], true) ?>
                                                            <h5><b>Visitor IP address:</b></h5>
                                                            <p>{{@$user_info['remote_addr']}}</p>

                                                            <h5><b>Browser (User Agent) Info:</b></h5>
                                                            <p>{{@$user_info['user_agent']}}</p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-raised mt20" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                    <td><span class="word-inline">{{format_date_time($content['created_at'])}}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td><h4>No Activity Found</h4></td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        {{$activity->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
.word-inline {
    white-space: nowrap;
    overflow-y: auto;
}
</style>