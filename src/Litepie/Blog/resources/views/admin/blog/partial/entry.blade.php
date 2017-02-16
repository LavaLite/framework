<div class="row disabled">
      <div class='col-md-12 col-sm-12'>
             {!! Form::text('title')
             ->required()
             -> label(trans('blog::blog.label.title'))
             -> placeholder(trans('blog::blog.placeholder.title'))!!}
      </div>

      <div class='col-md-6 col-sm-6'>
             {!! Form::select('category_id')
              ->options(Blog::selectCategories())
             ->required()
             -> label(trans('blog::blog.label.category_id'))
             -> placeholder(trans('blog::blog.placeholder.category_id'))!!}
      </div>

      <div class='col-md-6 col-sm-6'>
             {!! Form::select('status')
             -> options(trans('blog::blog.options.status'))
             -> label(trans('blog::blog.label.status'))
             -> placeholder(trans('blog::blog.placeholder.status'))
             -> required()!!}
      </div>

      <div class='col-md-12 col-sm-12'>
             {!! Form::textarea('description')
             -> addClass('html-editor')
             -> label(trans('blog::blog.label.description'))
             -> placeholder(trans('blog::blog.placeholder.description'))!!}
      </div>      
</div>

