<div class="tab-pane active" id="details">
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::text('name')
            -> label(trans('menu.label.name'))
            -> placeholder(trans('menu.placeholder.name'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::text('url')
            -> label(trans('menu.label.url'))
            -> placeholder(trans('menu.placeholder.url'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::text('order')
            -> label(trans('menu.label.order'))
            -> placeholder(trans('menu.placeholder.order'))!!}
        </div>
        <div class="col-md-6">
            {!! Form::select('status')
            -> options(trans('menu.options.status'))
            -> label(trans('menu.label.status'))
            -> placeholder(trans('menu.placeholder.status'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::select('open')
            -> options(trans('menu.options.open'))
            -> label(trans('menu.label.open'))
            -> placeholder(trans('menu.placeholder.open'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::hidden('has_sub')
            -> forceValue('0')!!}
            {!! Form::checkbox('has_sub')
            -> label(trans('menu.label.has_sub'))
            -> addClass('checkbox-has_sub')!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::text('key')
            -> label(trans('menu.label.key'))
            -> placeholder(trans('menu.placeholder.key'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::text('icon')
            -> label(trans('menu.label.icon'))
            -> placeholder(trans('menu.placeholder.icon'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            {!! Form::textarea('description')
            -> label(trans('menu.label.description'))
            -> placeholder(trans('menu.placeholder.description'))!!}
            {!! Form::hidden('parent_id')->id('parent_id') !!}
        </div>
    </div>
</div>