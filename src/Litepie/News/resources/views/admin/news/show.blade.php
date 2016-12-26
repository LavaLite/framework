<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">  {!! trans('news::news.name') !!}</a></li>
        <li ><a href="#images" data-toggle="tab">Images</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#news-news-entry' data-href='{{trans_url('admin/news/news/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($news->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#news-news-entry' data-href='{{ trans_url('/admin/news/news') }}/{{$news->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#news-news-entry' data-datatable='#news-news-list' data-href='{{ trans_url('/admin/news/news') }}/{{$news->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif

        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('news-news-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/news/news'))!!}
       <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title ">  {!! trans('app.view') !!}  {!! trans('news::news.name') !!} [ {!!$news->title!!} ] </div>
                @include('news::admin.news.partial.entry')
            </div>
            <div class="tab-pane" id="images"> 
                <div class="row">               
                    <div class='col-md-6 col-sm-6'>
                     <label>Images</label><br>
                          {!!@$news->fileShow('images')!!}
                    </div>
                </div>
            </div>
        </div>   
    {!! Form::close() !!}
</div>