            <div class="tab-pane active" id="details">
                <div class="row">
                    <div class="col-md-6 ">
                        {!! Form::text('name')
                        -> label(trans('Menu::menu.label.name'))
                        -> required()
                        -> placeholder(trans('Menu::menu.placeholder.name'))!!}
                    </div>
                    <div class="col-md-6 ">
                        {!! Form::text('key')
                        -> label(trans('Menu::menu.label.key'))
                        -> required()
                        -> placeholder(trans('Menu::menu.placeholder.key'))!!}
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
                        -> options(Lang::get('Menu::menu.options.status'))
                        -> label(trans('Menu::menu.label.status'))
                        -> placeholder(trans('Menu::menu.placeholder.status'))!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        {!! Form::textarea('description')
                        -> label(trans('Menu::menu.label.description'))
                        -> placeholder(trans('Menu::menu.placeholder.description'))!!}
                    </div>
                </div>
            </div>
