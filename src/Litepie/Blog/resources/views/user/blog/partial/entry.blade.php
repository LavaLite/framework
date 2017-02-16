{!! Form::hidden('upload_folder')!!}
<div class="row">
    <div class="col-sm-12">
        {!! Form::text('title')
        ->label('BLOG TITLE')
        ->required()
        -> placeholder(trans('blog::blog.placeholder.title'))!!}
    </div>
    <div class="col-sm-6">
        {!! Form::select('status')
          -> options(trans('blog::blog.options.status'))
          -> label('STATUS')
          -> placeholder(trans('blog::blog.placeholder.status'))!!}
    </div>
    <div class="col-sm-6">
        {!! Form::select('category_id')
        ->required()
        ->options(Blog::selectCategories())
        -> label('BLOG CATEGORY')
        -> placeholder(trans('blog::blog.placeholder.category_id'))!!}
    </div>
    <div class="col-sm-12">
        {!! Form::textarea('description')
        -> label('BLOG CONTENT')
        -> addClass('html-editor')
        -> placeholder(trans('blog::blog.placeholder.description'))
        !!}
    </div>
    <div class="col-sm-12 profile-pic">
        <label for="name">
            BLOG IMAGES
        </label>
        <div>
            {!! $blog->fileUpload('images')!!}
            {!! $blog->fileEdit('images') !!}
        </div>
    </div>
</div>
<style>
    sup
    {
        color:red;
    }
</style>
