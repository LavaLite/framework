<div class='col-md-6 col-sm-6'>
       {!! Form::text('name')
       -> required()
       -> label(trans('user::team.label.name'))
       -> placeholder(trans('user::team.placeholder.name'))!!}
</div> 
<div class='col-md-6 col-sm-6'>
       {!! Form::select('manager_id')
       -> required()
       -> label(trans('user::team.label.manager'))
       -> options(User::agents())
       -> placeholder(trans('user::team.placeholder.manager'))!!}
</div>
      
<div class='col-md-12 col-sm-12'>
       {!! Form::textarea('description')
       -> required()
       -> label(trans('user::team.label.description'))
       -> placeholder(trans('user::team.placeholder.description'))
       -> rows(5)!!}
</div>  