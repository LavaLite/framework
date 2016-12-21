<div class="row"> 
    <div class='col-md-4 col-sm-6'>
           {!! Form::text('name')
           -> required()
           -> label(trans('user::team.label.name'))
           -> placeholder(trans('user::team.placeholder.name'))!!}
    </div>

    <div class='col-md-4 col-sm-6'>
           {!! Form::text('description')
           -> required()
           -> label(trans('user::team.label.description'))
           -> placeholder(trans('user::team.placeholder.description'))!!}
    </div>

    <div class='col-md-4 col-sm-6'>
           {!! Form::text('settings')
           -> label(trans('user::team.label.settings'))
           -> placeholder(trans('user::team.placeholder.settings'))!!}
    </div>
</div>