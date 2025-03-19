<div class="row">
    <div class="col-md-12 ">
        {!!form()->hidden('upload_folder')!!}
        {!!form()->text('name')
        -> value($menu['name'])
        -> required()
        -> label(trans('menu::menu.label.name'))
        -> placeholder(trans('menu::menu.placeholder.name'))!!}
    </div>
    <div class="col-md-8 ">
        {!!form()->text('url')
        -> value($menu['url'])
        -> required()
        -> label(trans('menu::menu.label.url'))
        -> placeholder(trans('menu::menu.placeholder.url'))!!}
    </div>
    <div class="col-md-4 ">
        {!!form()->select('target')
        -> value($menu['target'])
        -> options(trans('menu::menu.options.target'))
        -> label(trans('menu::menu.label.target'))
        -> placeholder(trans('menu::menu.placeholder.target'))!!}
    </div>
    <div class="col-md-6 ">
        {!!form()->hidden('role[]')!!}
        {!!form()->select('role[]')
        -> options(role()->select([]), $menu['role'])
        -> value($menu['role'])
        -> multiple('multiple')
        -> class('select-remote form-control')
        -> label(trans('menu::menu.label.role'))!!}
    </div>
    <div class="col-md-6">
        {!!form()->select('status')
        -> options(trans('menu::menu.options.status'))
        -> value($menu['status'])
        -> label(trans('menu::menu.label.status'))
        -> placeholder(trans('menu::menu.placeholder.status'))!!}
    </div>
    <div class="col-md-4">
        {!!form()->text('icon')
        -> value($menu['icon'])
        -> label(trans('menu::menu.label.icon'))
        -> placeholder(trans('menu::menu.placeholder.icon'))!!}
    </div>
    <div class="col-md-8 ">
        {!!form()->text('description')
        -> value($menu['description'])
        -> label(trans('menu::menu.label.description'))
        -> placeholder(trans('menu::menu.placeholder.description'))!!}
        {!!form()->hidden('parent_id')
            -> value($menu['parent_id'])
            ->id('parent_id') !!}
    </div>
</div>
