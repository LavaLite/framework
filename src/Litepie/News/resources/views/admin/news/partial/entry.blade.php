  <div class="row disabled">
        <div class='col-md-4 col-sm-6'>
               {!! Form::text('title')
               -> label(trans('news::news.label.title'))
               -> required()
               -> placeholder(trans('news::news.placeholder.title'))!!}
        </div>
        <div class='col-md-4 col-sm-6'>
               {!! Form::select('status')
               -> options(trans('news::news.options.status'))
               -> label(trans('news::news.label.status'))
               -> required()
               -> placeholder(trans('news::news.placeholder.status'))!!}
        </div>
        <div class='col-md-12'>
            {!! Form::textarea('description')
            -> label(trans('news::news.label.description'))
            -> dataUpload(URL::to($news->getUploadURL('description')))
            -> addClass('html-editor')
            -> required()
            -> placeholder(trans('news::news.placeholder.description'))!!}
        </div>
  </div>



