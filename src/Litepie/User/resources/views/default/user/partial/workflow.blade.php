    @if(property_exists('workflow', $user))
        @if($user->hasStep('active'))
            <button type="button" class="btn bg-orange btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $user->getRouteKey() .'/complete')}}" data-value="No" data-datatable='#news-news-list'><i class="fa fa-check"></i> {{trans('app.active')}}</button>
        @endif

        @if($user->hasStep('suspend'))
            <button type="button" class="btn bg-olive btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $user->getRouteKey() .'/verify')}}" data-value="Yes" data-datatable='#news-news-list'><i class="fa fa-check"></i> {{trans('app.suspend')}}</button>
        @endif

        @if($user->hasStep('unsuspend'))
            <button type="button" class="btn bg-aqua btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $user->getRouteKey() .'/approve')}}" data-value="Yes" data-datatable='#news-news-list'><i class="fa fa-check"></i> {{trans('app.unsuspend')}}</button>
        @endif
    @endif
