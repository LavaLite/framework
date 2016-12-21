
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
                @include('vuser::admin.team.partial.entry')
            </div>
        </div>
    {!! Form::close() !!}
</div>