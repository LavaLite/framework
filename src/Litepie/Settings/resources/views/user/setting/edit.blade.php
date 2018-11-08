<div class="container-fluid"> 
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                {!!Form::vertical_open()
                ->id('edit-settings-setting')
                ->method('PUT')
                ->files('true')
                ->class('dashboard-form')
                ->action(guard_url('/settings/setting') .'/'.$setting->getRouteKey())!!}
                <div class="header with-sub" data-background-color="red">
                    <div class="row">
                        <div class="col-sm-11 title-main">
                            <i class="pe-7s-news-paper"></i>
                            <h4 class="title">Update Setting</h4>
                            <p class="sub-title">Last updated on {{format_date($setting['updated_at'])}}</p>
                        </div>
                        <div class="col-sm-1">
                            <a href="{{guard_url('/settings/setting')}}" rel="tooltip" class="btn btn-white btn-round btn-simple btn-icon pull-right add-new" data-original-title="" title="">
                                    <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    @include('public::notifications')
                    @include('settings::user.setting.partial.entry')
                </div>
                <div class="footer">
                    <button class="btn-primary btn-raised btn btn-sm" type="submit">{{ trans('app.update')  }} {!! trans('settings::setting.name') !!}</button>
                    <a href="{{ guard_url('/settings/setting') }}" class="btn-danger btn-raised btn btn-sm" >{{ trans('app.cancel')  }}</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

