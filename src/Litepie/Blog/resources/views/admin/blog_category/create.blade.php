<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('app.create') }}  {!! trans('blog::blog_category.name') !!} </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#blog-blog_category-create'  data-load-to='#blog-blog_category-entry' data-datatable='#blog-blog_category-list'><i class="fa fa-floppy-o"></i> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#blog-blog_category-entry' data-href='{{Trans::to('admin/blog/blog_category/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Category</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('blog-blog_category-create')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/blog/blog_category'))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                @include('blog::admin.blog_category.partial.entry')
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>