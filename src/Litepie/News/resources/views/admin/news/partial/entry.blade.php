  <div class="row disabled">
        <div class='col-md-12 col-sm-12'>
               {!! Form::text('title')
               -> label(trans('news::news.label.title'))
               -> required()
               -> placeholder(trans('news::news.placeholder.title'))!!}
        </div>      

        <div class='col-md-12'>
            {!! Form::textarea('description')
            -> label(trans('news::news.label.description'))
            -> dataUpload(trans_url($news->getUploadURL('description')))
            -> addClass('html-editor')
            -> required()
            -> placeholder(trans('news::news.placeholder.description'))!!}
        </div>
  </div>