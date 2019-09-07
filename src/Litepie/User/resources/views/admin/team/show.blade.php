    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('user::team.name') !!}</a></li>
            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#teams-team-entry' data-href='{{guard_url('user/team/create')}}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }}</button>
                @if($team->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#teams-team-entry' data-href='{{ guard_url('user/team') }}/{{$team->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#teams-team-entry' data-datatable='#teams-team-list' data-href='{{ guard_url('user/team') }}/{{$team->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('teams-team-show')
        ->method('POST')
        ->files('true')
        ->action(guard_url('user/team'))!!}
            <div class="tab-content clearfix disabled">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('user::team.name') !!}  [{!! $team->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('user::admin.team.partial.entry', ['mode' => 'show'])
                </div>
            </div>
        {!! Form::close() !!}
    </div>