    @if(property_exists('workflow', $permission))
        @if($permission->hasStep('complete'))
            <button type="button" class="btn bg-orange btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $permission->getRouteKey() .'/complete')}}" data-value="No" data-datatable='#news-news-list'><i class="fa fa-check"></i> Complete</button>
        @endif

        @if($permission->hasStep('verify'))
            <button type="button" class="btn bg-olive btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $permission->getRouteKey() .'/verify')}}" data-value="Yes" data-datatable='#news-news-list'><i class="fa fa-check"></i> Verify</button>
        @endif

        @if($permission->hasStep('approve'))
            <button type="button" class="btn bg-aqua btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $permission->getRouteKey() .'/approve')}}" data-value="Yes" data-datatable='#news-news-list'><i class="fa fa-check"></i> Approve</button>
        @endif

        @if($permission->hasStep('publish'))
            <button type="button" class="btn bg-purple btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $permission->getRouteKey() .'/publish')}}" data-value="Yes" data-datatable='#news-news-list'><i class="fa fa-check"></i> Publish</button>
        @endif

        @if($permission->hasStep('unpublish'))
            <button type="button" class="btn bg-maroon btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $permission->getRouteKey() .'/unpublish')}}" data-value="Yes" data-datatable='#news-news-list'><i class="fa fa-times-circle"></i> Unpublish</button>
        @endif

        @if($permission->hasStep('archive'))
            <button type="button" class="btn bg-navy btn-sm" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $permission->getRouteKey() .'/archive')}}" data-value="Yes" data-datatable='#news-news-list'><i class="fa fa-file-archive-o "></i> Archive</button>
        @endif
    @endif
