<div class='row disabled'>
    <div class='col-md-6 col-sm-6'>
           {!! Form::text('name')
           -> required()
           -> label(trans('blog::blog_category.label.name'))
           -> placeholder(trans('blog::blog_category.placeholder.name'))!!}
    </div>

    <div class='col-md-6 col-sm-6'>
           {!! Form::select('status')
           -> options(trans('blog::blog.options.status'))
           -> label(trans('blog::blog_category.label.status'))
           -> placeholder(trans('blog::blog_category.placeholder.status'))!!}
    </div>
</div>