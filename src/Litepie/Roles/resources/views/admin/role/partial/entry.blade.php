            <div class='row'>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('roles::role.label.name'))
                       -> placeholder(trans('roles::role.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('slug')
                       -> label(trans('roles::role.label.slug'))
                       -> placeholder(trans('roles::role.placeholder.slug'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('description')
                       -> label(trans('roles::role.label.description'))
                       -> placeholder(trans('roles::role.placeholder.description'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::numeric('level')
                       -> label(trans('roles::role.label.level'))
                       -> placeholder(trans('roles::role.placeholder.level'))!!}
                </div>
            </div>