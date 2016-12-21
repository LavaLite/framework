
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">{{ trans('page::page.tab.page') }}</a></li>
            <li><a href="#metatags" data-toggle="tab">{{ trans('page::page.tab.meta') }}</a></li>
            <li><a href="#settings" data-toggle="tab">{{ trans('page::page.tab.setting') }}</a></li>
            <li><a href="#images" data-toggle="tab">{{ trans('page::page.tab.image') }}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#page-page-entry' data-href='{{Trans::to('admin/page/page/create')}}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }}</button>
                @if($page->id)
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#page-page-entry' data-href='{{ trans_url('/admin/page/page') }}/{{$page->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#page-page-entry' data-datatable='#main-list' data-href='{{ trans_url('/admin/page/page') }}/{{$page->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('show-page-show')
        ->method('PUT')
        ->action(trans_url('admin/page/page/'. $page->getRouteKey()))!!}
        {!!Form::token()!!}
        <div class="tab-content clearfix">
                 
            <div class="tab-pan-title">  {{ trans('app.show') }}   [{!!$page->name!!}]</div>             
           
                @include('page::admin.page.partial.entry')             
                <div class="tab-pane disabled row" id="images">
                    <div class='col-md-12'>
                        {!! $page->fileShow('banner') !!}
                    </div>
                    <div class='col-md-12'>
                        {!! $page->fileShow('images') !!}
                    </div>
                </div>
           
        </div>
    </div>
