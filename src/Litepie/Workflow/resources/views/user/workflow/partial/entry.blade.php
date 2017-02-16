<div class='col-md-4 col-sm-6'>
                       {!! Form::text('workflowable_id')
                       -> label(trans('workflow::workflow.label.workflowable_id'))
                       -> placeholder(trans('workflow::workflow.placeholder.workflowable_id'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('workflowable_type')
                       -> label(trans('workflow::workflow.label.workflowable_type'))
                       -> placeholder(trans('workflow::workflow.placeholder.workflowable_type'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('action')
                       -> label(trans('workflow::workflow.label.action'))
                       -> placeholder(trans('workflow::workflow.placeholder.action'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::select('status')
                    -> options(trans('workflow::workflow.options.status'))
                    -> label(trans('workflow::workflow.label.status'))
                    -> placeholder(trans('workflow::workflow.placeholder.status'))!!}
               </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::textarea ('comment')
                    -> label(trans('workflow::workflow.label.comment'))
                    -> placeholder(trans('workflow::workflow.placeholder.comment'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::textarea ('data')
                    -> label(trans('workflow::workflow.label.data'))
                    -> placeholder(trans('workflow::workflow.placeholder.data'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('performable_id')
                       -> label(trans('workflow::workflow.label.performable_id'))
                       -> placeholder(trans('workflow::workflow.placeholder.performable_id'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('performable_type')
                       -> label(trans('workflow::workflow.label.performable_type'))
                       -> placeholder(trans('workflow::workflow.placeholder.performable_type'))!!}
                </div>

{!!   Form::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}