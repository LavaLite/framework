

@include('public::notifications')
{!!Form::vertical_open()
->id('form-change-password')
->action('admin/password')
->method('POST')
->class('change-password')!!}

{!! Form::password('old_password')
-> label(trans('user::user.label.current_password'))
-> placeholder(trans('user::user.placeholder.current_password'))!!}

{!! Form::password('password')
-> label(trans('user::user.label.new_password'))
-> placeholder(trans('user::user.placeholder.new_password'))!!}


{!! Form::password('password_confirmation')
-> label(trans('user::user.label.new_password_confirmation'))
-> placeholder(trans('user::user.placeholder.new_password_confirmation'))!!}

{!! Form::close() !!}
