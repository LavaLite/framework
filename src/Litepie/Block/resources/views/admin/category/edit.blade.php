
<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#category" data-toggle="tab">{!! trans('block::category.tab.name') !!}</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#block-category-edit'  data-load-to='#block-category-entry' data-datatable='#block-category-list'><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#block-category-entry' data-href='{{trans_url('admin/block/category')}}/{{$category->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('block-category-edit')
    ->method('PUT')
    ->enctype('multipart/form-data')
    ->action(trans_url('admin/block/category/'. $category->getRouteKey()))!!}
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="category">
            <div class="tab-pan-title">  {!! trans('app.edit') !!}  {!! trans('block::category.name') !!} [ {!!$category->name!!} ] </div>
            @include('block::admin.category.partial.entry')
        </div>
    </div>
    {!!Form::close()!!}
</div>