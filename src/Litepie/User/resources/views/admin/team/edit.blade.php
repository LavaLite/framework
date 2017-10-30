
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#team" data-toggle="tab">{!! trans('user::team.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#user-team-edit'  data-load-to='#user-team-entry' data-datatable='#user-team-list'><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#user-team-entry' data-href='{{trans_url('admin/user/team')}}/{{$team->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-team-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/user/team/'. $team->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="team">
                <div class="tab-pan-title">  {!! trans('app.edit') !!}  {!! trans('user::team.name') !!} [ {!!$team->name!!} ] </div>
                <div class='row'>
                    <div class='col-md-6 col-sm-6'>
                        @include('user::admin.team.partial.entry')
                    </div>

                    <div class='col-md-3 col-sm-3'>
                        <label>Icon</label>
                        {!!@$team->files('icon')->url($team->getUploadUrl('icon'))->dropzone()!!}
                    </div>
                    <div class='col-md-3 col-sm-3'>
                        {!!@$team->files('icon')!!}
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}
    </div>