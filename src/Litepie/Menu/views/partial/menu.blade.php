            <div class="tab-pane active" id="details">
                <div class="row">
                    <div class="col-md-6 ">
                        {!! Form::text('name')
                        -> label(trans('menu.label.name'))
                        -> required()
                        -> placeholder(trans('menu.placeholder.name'))!!}
                    </div>
                    <div class="col-md-6 ">
                        {!! Form::text('key')
                        -> label(trans('menu.label.key'))
                        -> required()
                        -> placeholder(trans('menu.placeholder.key'))!!}
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
                        -> options(Lang::get('menu.options.status'))
                        -> label(trans('menu.label.status'))
                        -> placeholder(trans('menu.placeholder.status'))!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        {!! Form::textarea('description')
                        -> label(trans('menu.label.description'))
                        -> placeholder(trans('menu.placeholder.description'))!!}
                    </div>
                </div>
            </div>
