<div class="box-header with-border">
    <h3 class="box-title"> Edit  {!! trans('blog::blog_category.name') !!} [{!!$blog_category->name!!}] </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#blog-blog_category-edit'  data-load-to='#blog-blog_category-entry' data-datatable='#blog-blog_category-list'><i class="fa fa-floppy-o"></i> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#blog-blog_category-entry' data-href='{{Trans::to('admin/blog/blog_category')}}/{{$blog_category->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('cms.cancel') }}</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#blog_category" data-toggle="tab">{!! trans('blog::blog_category.tab.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('blog-blog_category-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/blog/blog_category/'. $blog_category->getRouteKey()))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="blog_category">
                @include('blog::admin.blog_category.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>