            <div class='row'>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> required()
                       -> label(trans('roles::permission.label.name'))
                       -> placeholder(trans('roles::permission.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('slug')
                       -> required()
                       -> label(trans('roles::permission.label.slug'))
                       -> placeholder(trans('roles::permission.placeholder.slug'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('description')
                       -> label(trans('roles::permission.label.description'))
                       -> placeholder(trans('roles::permission.placeholder.description'))!!}
                </div>
            </div>