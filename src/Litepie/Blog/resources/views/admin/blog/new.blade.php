<div class="box-header with-border">
    <h3 class="box-title">  {!! trans('blog::blog.names') !!}</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm"  data-action='NEW' data-load-to='#blog-blog-entry' data-href='{!!trans_url('admin/blog/blog/create')!!}'><i class="fa fa-plus-circle"></i> New </button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" style="min-height:100px">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <h1 class="text-center">
            <small>
            <button type="button" class="btn btn-app" data-toggle="tooltip" data-placement="top" title="" data-action='NEW' data-load-to='#blog-blog-entry' data-href='{!!trans_url('admin/blog/blog/create')!!}'>
            <span class="badge bg-purple">{!! Blog::count('blog') !!}</span>
            <i class="fa fa-plus-circle  fa-3x"></i>
            {{ trans('cms.create') }} {!! trans('blog::blog.name') !!}
            </button>
            <br>{!! trans('blog::blog.text.preview') !!}
            </small>
            </h1>
        </div>
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>