<div class='row disabled'>
 {!! Form::hidden('upload_folder')!!}
  <div class='col-md-6 col-sm-6'>
         {!! Form::text('name')
         -> required()
         -> label(trans('block::block.label.name'))
         -> placeholder(trans('block::block.placeholder.name'))!!}
  </div>
  <div class='col-md-6 col-sm-6'>
         {!! Form::select('category_id')
         ->required()
         ->options(Block::selectCategories())
         -> label(trans('block::block.label.category_id'))
         -> placeholder(trans('block::block.placeholder.category_id'))!!}
  </div>
  <div class='col-md-6 col-sm-6'>
         {!! Form::select('status')
           -> options(trans('block::block.options.status'))
         -> label(trans('block::block.label.status'))
         -> placeholder(trans('block::block.placeholder.status'))!!}
  </div>
  <div class='col-md-6 col-sm-6'>
         {!! Form::text('url')
         -> label(trans('block::block.label.url'))
         -> placeholder(trans('block::block.placeholder.url'))!!}
  </div>
  <div class='col-md-6 col-sm-6'>
         {!! Form::number('order')
         -> label(trans('block::block.label.order'))
         -> placeholder(trans('block::block.placeholder.order'))!!}
  </div>
  <div class='col-md-6 col-sm-6'>
         {!! Form::text('icon')
         -> label(trans('block::block.label.icon'))
         -> placeholder(trans('block::block.placeholder.icon'))!!}
  </div>
  <div class='col-md-12 col-sm-12'>
         {!! Form::textarea('description')
         -> addClass('html-editor')
         -> label(trans('block::block.label.description'))
         -> placeholder(trans('block::block.placeholder.description'))!!}
  </div>
</div>
