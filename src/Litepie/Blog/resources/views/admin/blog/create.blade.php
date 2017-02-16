
<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">Contact</a></li>
        <li ><a href="#images" data-toggle="tab">Images</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#blog-blog-create'  data-load-to='#blog-blog-entry' data-datatable='#blog-blog-list'><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#blog-blog-entry' data-href='{{trans_url('admin/blog/blog/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('blog-blog-create')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/blog/blog'))!!}

        <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {!! trans('app.create') !!}  {!! trans('blog::blog.name') !!} </div>
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

                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>