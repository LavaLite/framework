
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#team" data-toggle="tab">  {!! trans('user::team.name') !!}</a></li>        
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#user-team-entry' data-href='{{trans_url('admin/user/team/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($team->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#user-team-entry' data-href='{{ trans_url('/admin/user/team') }}/{{$team->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#user-team-entry' data-datatable='#user-team-list' data-href='{{ trans_url('/admin/user/team') }}/{{$team->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('user-team-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/user/team'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="team">
                <div class="tab-pan-title">  {!! trans('app.view') !!}  {!! trans('user::team.name') !!} [ {!!$team->name!!} ] </div>
                <div class='row'>
                    <div class='col-md-6 col-sm-6 disabled'>
                        @include('user::admin.team.partial.entry')
                        <div class='col-md-12 col-sm-12'>
                            <label>Icon</label>
                            {!!@$team->files('icon')!!}
                        </div>
                    </div>
                    <div class='col-md-6 col-sm-6'>
                        <?php
                            $members = @$team->member;
                        ?>
                        @include('user::admin.team.members')
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>

<div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #dd4b39;color: #fff;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h3 class="modal-title">Revision Values</h3>
        </div>
        <div class="modal-body" style="min-height:220px;">
            <div class='col-md-12'></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="btn-save-users">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

    </div>          
  </div>
</div>

<script type="text/javascript">

$(document).ready(function(){  
    $("#btn-add-agents").click(function(){

        $("#agentModal .modal-body").load('{{trans_url("/admin/user/user")}}');
        $("#agentModal").modal('show');
    });
});

</script>