<div class="box-header with-border">
    <h3 class="box-title"> {!! trans('blog::blog_category.name') !!}  [{!! $blog_category->name !!}]  </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#blog-blog_category-entry' data-href='{{trans_url('admin/blog/blog_category/create')}}'><i class="fa fa-plus-circle"></i> New</button>
        @if($blog_category->id )
        <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#blog-blog_category-entry' data-href='{{ trans_url('/admin/blog/blog_category') }}/{{$blog_category->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#blog-blog_category-entry' data-datatable='#blog-blog_category-list' data-href='{{ trans_url('/admin/blog/blog_category') }}/{{$blog_category->getRouteKey()}}' >
        <i class="fa fa-times-circle"></i> Delete
        </button>
        @endif
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('blog::blog_category.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('blog-blog_category-show')
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