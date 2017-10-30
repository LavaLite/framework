
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#team" data-toggle="tab">{!! trans('user::team.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#user-team-create'  data-load-to='#user-team-entry' data-datatable='#user-team-list'><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#user-team-entry' data-href='{{trans_url('admin/user/team/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-team-create')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/user/team'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="team">
                <div class="tab-pan-title">  {!! trans('app.create') !!}  {!! trans('user::team.name') !!} </div>
                <div class='row'>
                    <div class='col-md-6 col-sm-6'>
                        @include('user::admin.team.partial.entry')
                    </div>
                    <div class='col-md-3 col-sm-3'>
                        <label>Icon</label>
                        {!!@$team->files('icon')->url($team->getUploadUrl('icon'))->dropzone()!!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>