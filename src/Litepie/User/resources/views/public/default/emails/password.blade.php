Click on the below link to reset your password: <br/>
<a href='{{ url('password/reset/'.$token) }}?role={{Request::get('role')}}'>{{ url('password/reset/'.$token) }}?role={{Request::get('role')}}</a>
