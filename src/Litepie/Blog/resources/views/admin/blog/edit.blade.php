
<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">{!! trans('blog::blog.tab.name') !!}</a></li>
        <li ><a href="#images" data-toggle="tab">Images</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#blog-blog-edit'  data-load-to='#blog-blog-entry' data-datatable='#blog-blog-list'><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#blog-blog-entry' data-href='{{trans_url('admin/blog/blog')}}/{{$blog->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('blog-blog-edit')
    ->method('PUT')
    ->enctype('multipart/form-data')
    ->action(trans_url('admin/blog/blog/'. $blog->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {!! trans('app.edit') !!}  {!! trans('blog::blog.name') !!} [ {!!$blog->title!!} ] </div>
                @include('blog::admin.blog.partial.entry')
            </div>
            <div class="tab-pane" id="images">
                <div class="row">
                    <div class="form-group">
                        <label for="images" class="control-label col-lg-12 col-sm-12 text-left">
                            {{trans('blog::blog.label.images') }}
                        </label>
                        <div class='col-lg-6 col-sm-12'>
                            {!! $blog->fileUpload('images')!!}
                        </div>
                        <div class='col-lg-12 col-sm-12'>
                            {!! $blog->fileEdit('images')!!}
                        </div>
                    </div>
                </div>
             </div>
        </div>
    {!!Form::close()!!}
</div>