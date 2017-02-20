<div class="box-header with-border">
    <h3 class="box-title"> {!! trans('blog::category.name') !!}  [{!! $category->name !!}]  </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#blog-category-entry' data-href='{{trans_url('admin/blog/category/create')}}'><i class="fa fa-plus-circle"></i> New</button>
        @if($category->id )
        <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#blog-category-entry' data-href='{{ trans_url('/admin/blog/category') }}/{{$category->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#blog-category-entry' data-datatable='#blog-category-list' data-href='{{ trans_url('/admin/blog/category') }}/{{$category->getRouteKey()}}' >
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
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('blog::category.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('blog-category-show')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/blog/category'))!!}
            <div class="tab-content">
                <div class="tab-pane active" id="details">
                    @include('blog::admin.category.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>