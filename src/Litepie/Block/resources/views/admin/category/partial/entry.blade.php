  <div class="row disabled">
      {!! Form::hidden('upload_folder')!!}
      <div class='col-md-4 col-sm-4'>
             {!! Form::text('name')
             -> label(trans('block::category.label.name'))
             -> placeholder(trans('block::category.placeholder.name'))
             -> required()!!}
      </div>
      <div class='col-md-4 col-sm-4'>
             {!! Form::text('slug')
             -> label(trans('block::category.label.slug'))
             -> placeholder(trans('block::category.placeholder.slug'))
             -> required()!!}
      </div>
      <div class='col-md-4 col-sm-4'>
             {!! Form::select('status')
             -> label(trans('block::category.label.status'))
             -> options(trans('block::category.options.status'))
             -> placeholder(trans('block::category.placeholder.status'))
            !!}
      </div>
      <div class='col-md-12 col-sm-12'>
             {!! Form::text('title')
             -> label(trans('block::category.label.title'))
             -> placeholder(trans('block::category.placeholder.title'))!!}
      </div>
      <div class='col-md-12 col-sm-12'>
             {!! Form::textarea('details')
             -> label(trans('block::category.label.details'))
             -> placeholder(trans('block::category.placeholder.details'))!!}
      </div>
  </div>

