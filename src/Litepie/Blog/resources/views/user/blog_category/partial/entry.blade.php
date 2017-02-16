{!! Form::hidden('upload_folder')!!}
<div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('blog::blog_category.label.name'))
                       -> placeholder(trans('blog::blog_category.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('status')
                       -> label(trans('blog::blog_category.label.status'))
                       -> placeholder(trans('blog::blog_category.placeholder.status'))!!}
                </div>

{!!   Form::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}