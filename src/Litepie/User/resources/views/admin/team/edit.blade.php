    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#team" data-toggle="tab">{!! trans('user::team.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#teams-team-edit'  data-load-to='#teams-team-entry' data-datatable='#teams-team-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#teams-team-entry' data-href='{{guard_url('user/team')}}/{{$team->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('teams-team-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(guard_url('user/team/'. $team->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="team">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('user::team.name') !!} [{!!$team->name!!}] </div>
                @include('user::admin.team.partial.entry', ['mode' => 'edit'])
            </div>
        </div>
        {!!Form::close()!!}
    </div>