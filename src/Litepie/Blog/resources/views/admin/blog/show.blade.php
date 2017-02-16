<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">  {!! trans('blog::blog.name') !!}</a></li>
        <li ><a href="#images" data-toggle="tab">Images</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#blog-blog-entry' data-href='{{trans_url('admin/blog/blog/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($blog->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#blog-blog-entry' data-href='{{ trans_url('/admin/blog/blog') }}/{{$blog->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#blog-blog-entry' data-datatable='#blog-blog-list' data-href='{{ trans_url('/admin/blog/blog') }}/{{$blog->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif

        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('blog-blog-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/blog/blog'))!!}
       <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title ">  {!! trans('app.view') !!}  {!! trans('blog::blog.name') !!} [ {!!$blog->title!!} ] </div>
                @include('blog::admin.blog.partial.entry')
            </div>
            <div class="tab-pane" id="images"> 
                <div class="row">               
                    <div class='col-md-6 col-sm-6'>
                     <label>Images</label><br>
                          {!!@$blog->fileShow('images')!!}
                    </div>
                </div>
            </div>
        </div>   
    {!! Form::close() !!}
</div>