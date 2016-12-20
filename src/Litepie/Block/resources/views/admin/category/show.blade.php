

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">  {!! trans('block::category.name') !!}</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#block-category-entry' data-href='{{trans_url('admin/block/category/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($category->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#block-category-entry' data-href='{{ trans_url('/admin/block/category') }}/{{$category->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#block-category-entry' data-datatable='#block-category-list' data-href='{{ trans_url('/admin/block/category') }}/{{$category->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif

        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('block-category-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/block/category'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {!! trans('app.view') !!}  {!! trans('block::category.name') !!} [ {!!$category->name!!} ] </div>
                @include('block::admin.category.partial.entry')
            </div>
        </div>
    {!! Form::close() !!}
</div>