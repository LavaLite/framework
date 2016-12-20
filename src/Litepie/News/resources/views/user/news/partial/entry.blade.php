

{!! Form::hidden('upload_folder')!!}

<div class="row">
    <div class="col-sm-12 col-md-12">
        {!! Form::text('title')
        ->label(trans('news::news.label.title'))
        ->addGroupClass('label-floating')
        ->required()!!}
    </div>
    <div class="col-sm-12 col-md-12">
        {!! Form::textarea('description')
        -> label(trans('news::news.label.description'))
        -> addClass('html-editor')
        ->addGroupClass('label-floating')
        -> placeholder(trans('news::news.placeholder.description'))
        !!}
    </div>
    <div class="col-sm-12 profile-pic col-md-12">
            
        <label for="images">
            News images
        </label>
        <div>
            {!! $news->fileUpload('images')!!}
        </div> 
        <div class="mt20">
            {!! $news->fileEdit('images') !!}
        </div>
    </div>
</div>
