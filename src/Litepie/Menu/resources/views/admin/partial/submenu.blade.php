<div class="tab-pane active disabled" id="details">
    <div class="tab-pan-title"> {{ trans('app.view') }} menu [{{$menu->name or 'New menu'}}]</div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::text('name')
            -> required()
            -> label(trans('menu::menu.label.name'))
            -> placeholder(trans('menu::menu.placeholder.name'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::text('url')
            -> required()
            -> label(trans('menu::menu.label.url'))
            -> placeholder(trans('menu::menu.placeholder.url'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Form::select('status')
            -> options(trans('menu::menu.options.status'))
            -> label(trans('menu::menu.label.status'))
            -> placeholder(trans('menu::menu.placeholder.status'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::select('target')
            -> options(trans('menu::menu.options.target'))
            -> label(trans('menu::menu.label.target'))
            -> placeholder(trans('menu::menu.placeholder.target'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::hidden('role[]')!!}
            {!! Form::select('role[]')
            -> options(User::roles(), $menu->role)
            -> multiple('multiple')
            -> class('select-remote form-control')
            -> label(trans('menu::menu.label.role'))!!}
        </div>
        <div class="col-md-6 ">
            {!! Form::text('icon')
            -> label(trans('menu::menu.label.icon'))
            -> placeholder(trans('menu::menu.placeholder.icon'))!!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            {!! Form::textarea('description')
            -> label(trans('menu::menu.label.description'))
            -> placeholder(trans('menu::menu.placeholder.description'))!!}
            {!! Form::hidden('parent_id')->id('parent_id') !!}
        </div>
    </div>
</div>
