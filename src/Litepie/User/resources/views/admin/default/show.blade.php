    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('user::client.name', ['client' => $type]) !!}</a></li>
            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#user-client-entry' data-href='{{guard_url('user/' . $type . '/create')}}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }}</button>
                @if($client->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#user-client-entry' data-href='{{ guard_url('user/' . $type) }}/{{$client->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#user-client-entry' data-datatable='#user-client-list' data-href='{{ guard_url('user/' . $type) }}/{{$client->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-client-show')
        ->method('POST')
        ->files('true')
        ->action(guard_url('user/' . $type))!!}
            <div class="tab-content clearfix disabled">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('user::client.name', ['client' => $type]) !!}  [{!! $client->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @includeFirst(['user::' . $type . '.partial.entry', 'user::default.partial.entry'], ['mode' => 'show'])
                </div>
            </div>
        {!! Form::close() !!}
    </div>