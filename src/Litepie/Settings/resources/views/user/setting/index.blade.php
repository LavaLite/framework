@include('public::notifications')
<div class="dashboard-content">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h3 class="panel-title">
                        {!! trans('settings::block.user.title') !!}
                    </h3>
                    <p class="panel-sub-title m-t-5 text-muted">
                        {!! trans('settings::block.user.subtitle') !!}
                    </p>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="row m-t-5">
                        <div class="col-xs-12 col-sm-7 m-b-5">
                                {!!Form::open()
                                ->method('GET')
                                ->action(trans_url('user/{!!$package!!}/block'))!!}
                                <div class="input-group">
                                    {!!Form::text('search')->type('text')->class('form-control')->placeholder('Search for blocks')->raw()!!}
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-danger" type="button">
                                            <i class="icon-magnifier">
                                            </i>
                                        </button>
                                    </span>
                                </div>
                                {!! Form::close()!!}
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <a class=" btn btn-success btn-block text-uppercase f-12" href="{{ trans_url('/user/settings/block/create') }}">
                                {{ trans('app.create')  }} Block
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body">



        <div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> My Settings </h4>
        </div>
        <div class="col-md-6">
            <a href="{{ trans_url('/user/settings/setting/create') }}" class="btn btn-default pull-right"> {{ trans('app.create')  }} Setting</a>
        </div>
    </div>
    <p class="text-muted m-b-25 font-13">
        Your awesome text goes here.
    </p>
    <hr>
    <div class="row">
        <div class="col-md-4 m-b-5 pull-right">
            {!!Form::open()->method('GET')!!}
            <div class="input-group">
              {!!Form::text('search')->type('search')->class('form-control')->placeholder('Search for...')->raw()!!}
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
              </span>
            </div>
            {!! Form::close()!!}
        </div>
    </div>   
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{!! trans('settings::setting.label.skey')!!}</th>
                    <th>{!! trans('settings::setting.label.name')!!}</th>
                    <th>{!! trans('settings::setting.label.value')!!}</th>
                    <th>{!! trans('settings::setting.label.type')!!}</th>
                    <th>{!! trans('settings::setting.label.status')!!}</th>
                    <th>{!! trans('settings::setting.label.created_at')!!}</th>
                    <th>{!! trans('settings::setting.label.updated_at')!!}</th>
                    <th width="150">{!! trans('settings::setting.label.status')!!}</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                <tr>
                    <td>{{ $setting->skey }}</td>
                    <td>{{ $setting->name }}</td>
                    <td>{{ $setting->value }}</td>
                    <td>{{ $setting->type }}</td>
                    <td><span class="label status-{{ $setting->status }}"> {{ $setting->status }} </span></td>
                    <td>
                        <a href="{{ trans_url('/user') }}/settings/setting/{!! $setting->getRouteKey() !!}"> View </a>
                        <a href="{{ trans_url('/user') }}/settings/setting/{!! $setting->getRouteKey() !!}/edit"> Edit </a>
                        <a data-action="DELETE" 
                            data-href="{{ trans_url('/user') }}/settings/setting/{!! $setting->getRouteKey() !!}" 
                            href="trans_url('/user')/settings/setting/{!! $setting->getRouteKey() !!}"> 
                            Delete 
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $settings->links() }}
</div>