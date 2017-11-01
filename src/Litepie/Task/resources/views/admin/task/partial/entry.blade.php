        <div class='col-md-12 col-sm-6'>
               {!! Form::text('task')
               -> required()
               -> label(trans('task::task.label.task'))
               -> placeholder(trans('task::task.placeholder.task'))!!}
        </div>

         <div class='col-md-12 col-sm-6'>
               {!! Form::textarea('description')
               -> label(trans('task::task.label.description'))
               -> placeholder(trans('task::task.placeholder.description'))!!}
        </div>

        <div class='col-md-6 col-sm-6'>
               {!! Form::date('start')
               -> label(trans('task::task.label.start'))
               -> placeholder(trans('task::task.placeholder.start'))!!}
        </div>

        <div class='col-md-6 col-sm-6'>
               {!! Form::select('priority')
               -> options(trans('task::task.options.priority'))
               -> placeholder(trans('task::task.placeholder.priority'))!!}
        </div>

        <div class='col-md-6 col-sm-6'>
               {!! Form::text('time_required')
               -> label(trans('task::task.label.time_required'))
               -> placeholder(trans('task::task.placeholder.time_required'))!!}
        </div>

        <div class='col-md-6 col-sm-6'>
              {!! Form::select('created')
               -> value(user_id())
               -> disabled()
               -> options(Task::users())
               -> label(trans('task::task.label.created_by'))              
               -> placeholder(trans('task::task.placeholder.created_by'))!!}
        </div>   

        <div class='col-md-6 col-sm-6'>
               {!! Form::select('assigned_to')
               -> options(@Task::users())
               -> placeholder(trans('task::task.placeholder.assigned_to'))!!}
        </div>