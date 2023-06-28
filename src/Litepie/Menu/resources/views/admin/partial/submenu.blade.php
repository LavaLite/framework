<div class="row">
    <div class="col-md-12 ">
        {!!Form::hidden('upload_folder')!!}
        {!! Form::text('name')
        -> value($menu['name'])
        -> required()
        -> label(trans('menu::menu.label.name'))
        -> placeholder(trans('menu::menu.placeholder.name'))!!}
    </div>
    <div class="col-md-8 ">
        {!! Form::text('url')
        -> value($menu['url'])
        -> required()
        -> label(trans('menu::menu.label.url'))
        -> placeholder(trans('menu::menu.placeholder.url'))!!}
    </div>
    <div class="col-md-4 ">
        {!! Form::select('target')
        -> value($menu['target'])
        -> options(trans('menu::menu.options.target'))
        -> label(trans('menu::menu.label.target'))
        -> placeholder(trans('menu::menu.placeholder.target'))!!}
    </div>
    <div class="col-md-6 ">
        {!! Form::hidden('role[]')!!}
        {!! Form::select('role[]')
        -> options(Role::select([]), $menu['role'])
        -> value($menu['role'])
        -> multiple('multiple')
        -> class('select-remote form-control')
        -> label(trans('menu::menu.label.role'))!!}
    </div>
    <div class="col-md-6">
        {!! Form::select('status')
        -> options(trans('menu::menu.options.status'))
        -> value($menu['status'])
        -> label(trans('menu::menu.label.status'))
        -> placeholder(trans('menu::menu.placeholder.status'))!!}
    </div>
    <div class="col-md-4">
        {!! Form::text('icon')
        -> value($menu['icon'])
        -> label(trans('menu::menu.label.icon'))
        -> placeholder(trans('menu::menu.placeholder.icon'))!!}
    </div>
    <div class="col-md-8 ">
        {!! Form::text('description')
        -> value($menu['description'])
        -> label(trans('menu::menu.label.description'))
        -> placeholder(trans('menu::menu.placeholder.description'))!!}
        {!! Form::hidden('parent_id')
            -> value($menu['parent_id'])
            ->id('parent_id') !!}
    </div>
</div>
