    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#client" data-toggle="tab">{!! trans('user::client.tab.name', ['client' => $type]) !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#user-client-edit'  data-load-to='#user-client-entry' data-datatable='#user-client-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#user-client-entry' data-href='{{guard_url('user/client')}}/{{$client->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-client-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(guard_url('user/' . $type . '/' . $client->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="client">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('user::client.name') !!} [{!!$client->name!!}] </div>
                @include('user::default.partial.entry', ['mode' => 'edit'])
            </div>
        </div>
        {!!Form::close()!!}
    </div>