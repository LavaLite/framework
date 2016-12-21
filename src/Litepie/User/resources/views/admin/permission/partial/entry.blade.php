<div class="row">
	<div class='col-md-4 col-sm-6'>
	       {!! Form::text('name')
	       -> label(trans('user::permission.label.name'))
	       -> required()
	       -> placeholder(trans('user::permission.placeholder.name'))!!}
	</div>
</div>