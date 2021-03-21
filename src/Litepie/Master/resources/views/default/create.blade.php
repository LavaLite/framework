<div class="app-list-wrap">
    <div class="app-list-inner">
        <div class="app-list-header d-flex align-items-center justify-content-between">
            <h3>{{__('Masters')}}</h3>
        </div>
        @include("master::menu")
    </div>
    <div class="app-detail-wrap" id="app-content">
    {!!Form::vertical_open()
        ->id('master-master-edit')
        ->method('POST')
        ->enctype('multipart/form-data')
        ->action(guard_url("masters/{$group}/master"))!!}
            @include('master::entry', ['mode' => 'create'])
        {!!Form::close()!!}
    </div>
</div>