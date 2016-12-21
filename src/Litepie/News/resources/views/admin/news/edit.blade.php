
<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">{!! trans('news::news.tab.name') !!}</a></li>
        <li ><a href="#images" data-toggle="tab">Images</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#news-news-edit'  data-load-to='#news-news-entry' data-datatable='#news-news-list'><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#news-news-entry' data-href='{{trans_url('admin/news/news')}}/{{$news->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('news-news-edit')
    ->method('PUT')
    ->enctype('multipart/form-data')
    ->action(trans_url('admin/news/news/'. $news->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {!! trans('app.edit') !!}  {!! trans('news::news.name') !!} [ {!!$news->title!!} ] </div>
                @include('news::admin.news.partial.entry')
            </div>
            <div class="tab-pane" id="images">
                <div class="row">
                    <div class="form-group">
                        <label for="images" class="control-label col-lg-12 col-sm-12 text-left">
                            {{trans('news::news.label.images') }}
                        </label>
                        <div class='col-lg-6 col-sm-12'>
                            {!! $news->fileUpload('images')!!}
                        </div>
                        <div class='col-lg-12 col-sm-12'>
                            {!! $news->fileEdit('images')!!}
                        </div>
                    </div>
                </div>
             </div>
        </div>
    {!!Form::close()!!}
</div>