<div class="container">
    <h1> Settings</h1>

    <div class="row">
        <div class="col-md-8">
            @forelse($settings as $setting)
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $setting['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('settings') }}/{!! $setting->getPublicKey() !!}" class="btn btn-default pull-right"> {{ trans('app.details')  }}</a>
                    </div>
                </div>
                <hr/>

                <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="skey">
                    {!! trans('settings::setting.label.skey') !!}
                </label><br />
                    {!! $setting['skey'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="name">
                    {!! trans('settings::setting.label.name') !!}
                </label><br />
                    {!! $setting['name'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="value">
                    {!! trans('settings::setting.label.value') !!}
                </label><br />
                    {!! $setting['value'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="type">
                    {!! trans('settings::setting.label.type') !!}
                </label><br />
                    {!! $setting['type'] !!}
            </div>
        </div>
    </div>
            </div>
            @empty
            <div class="card-box">
                <p class="text-muted m-b-25 font-13">
                    Your search for <b>'{{Request::get('search')}}'</b> returned empty result.
                </p>
            </div>
            @endif
            {{$settings->render()}}
        </div>
        <div class="col-md-4">
            @include('settings::public.setting.aside')
        </div>
    </div>
</div>