<div class='col-md-3 col-sm-6'>
    {!! Form::text('name')
    -> label(trans('user::user.role.label.name'))
    -> placeholder(trans('user::user.role.placeholder.name'))!!}
</div>
<div class='col-md-9 col-sm-6'>
    <table class="table">
        <thead>
            <th width="20%">Modules</th>
            <th>Permissions</th>
        </thead>
        <tbody>
            @foreach($permissions as $keyPermission => $permission)
            <tr>
                <td><strong>{{ucfirst($keyPermission)}}</strong></td>
                <td>
                    @forelse($permission as $key => $val)
                        <div class="checkbox checkbox-danger" style="float:left;width:150px;">
                            <input name="permissions[{{ $keyPermission. '.' .$key }}]" id="permissions.{{ $keyPermission. '.' .$key }}" type="checkbox" {{ @array_key_exists($keyPermission. '.' .$key, $role->permissions) ? 'checked' : '' }} value='1'>
                            <label for="permissions.{{ $keyPermission. '.' .$key }}">{{$val}}</label>
                        </div>
                    @empty
                        No permissions assigned
                    @endforelse
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style type="text/css">
.checkbox+.checkbox, .radio+.radio {
margin-top: 10px;
}
</style>
