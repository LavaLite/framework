<div class="tab-pane active" id="details">
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::text('name')
            -> label(trans('Menu::menu.label.name'))
            -> placeholder(trans('Menu::menu.placeholder.name'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::text('url')
            -> label(trans('Menu::menu.label.url'))
            -> placeholder(trans('Menu::menu.placeholder.url'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::text('order')
            -> label(trans('Menu::menu.label.order'))
            -> placeholder(trans('Menu::menu.placeholder.order'))!!}
        </div>
        <div class="col-md-6">
            {!! Form::select('status')
            -> options(trans('Menu::menu.options.status'))
            -> label(trans('Menu::menu.label.status'))
            -> placeholder(trans('Menu::menu.placeholder.status'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::select('open')
            -> options(trans('Menu::menu.options.open'))
            -> label(trans('Menu::menu.label.open'))
            -> placeholder(trans('Menu::menu.placeholder.open'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::hidden('has_sub')
            -> forceValue('0')!!}
            {!! Form::checkbox('has_sub')
            -> label(trans('Menu::menu.label.has_sub'))
            -> addClass('checkbox-has_sub')!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::text('key')
            -> label(trans('Menu::menu.label.key'))
            -> placeholder(trans('Menu::menu.placeholder.key'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::text('icon')
            -> label(trans('Menu::menu.label.icon'))
            -> placeholder(trans('Menu::menu.placeholder.icon'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            {!! Form::textarea('description')
            -> label(trans('Menu::menu.label.description'))
            -> placeholder(trans('Menu::menu.placeholder.description'))!!}
            {!! Form::hidden('parent_id')->id('parent_id') !!}
        </div>
    </div>
</div>