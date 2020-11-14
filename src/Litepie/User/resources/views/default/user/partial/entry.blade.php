
<div class="container-fluid">
  <div class="row">
    <div class='col-9'>
      <div class="app-entry-form-section" id="contact">
        <div class="section-title">Contact</div>
          <div class="row">
            <div class="col-12">
              {!! Form::text('name')
                          -> label(trans('user::user.label.name'))
                          -> placeholder(trans('user::user.placeholder.name')) !!}
            </div>
            <div class='col-12'>
                {!! Form::email('email')
                          -> label(trans('user::user.label.email'))
                          -> required()
                          -> placeholder(trans('user::user.placeholder.email')) !!}
            </div>
            <div class='col-12'>
                {!! Form::password('password')
                          -> label(trans('user::user.label.password').' <a href="javascript:void(0)" class="pwdedit"><i class="las la-pencil-alt" aria-hidden="true"></i></a>')
                          -> disabled(true)
                          -> placeholder(trans('user::user.placeholder.password')) !!}
            </div>
            <div class='col-12'>
                {!! Form::text('designation')
                          -> label(trans('user::user.label.designation'))
                          -> placeholder(trans('user::user.placeholder.designation')) !!}
            </div>
            <div class='col-12'>
                {!! Form::tel('mobile')
                        -> label(trans('user::user.label.mobile'))
                        -> placeholder(trans('user::user.placeholder.mobile')) !!}
            </div>
          </div>
          <div class="row">
            <div class='col-12 pb-2'>
              <div class="section-title">Roles</div>
                <div class="row">
                  @foreach ($roles as $role)
                    <div class="col-3">
                        <div class="custom-control custom-checkbox custom-control custom-checkbox pr-2" >
                          <input name="roles[{{ $role->id }}]" id="roles.{{ $role->id }}" class="custom-control-input" type="checkbox" {{ !($user->hasRole($role->slug)) ? :'checked'}} value='{{ $role->id }}'>
                          <label class="custom-control-label" for="roles.{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    </div>
                  @endforeach
                </div>
            </div>
          </div>
          <div class="row">
            <div class='col-12'>
              <div class="section-title">Permissions</div>
                  <div class="treeview" style="height:300px;overflow:auto;">
                    <ul style="margin-left:-40px;">
                        @foreach($permissions as $package => $modules)
                            <li class="custom-control custom-checkbox">
                              <input name="permissions[{{$package}}]" class="custom-control-input" id="permissions_{{$package}}" type="checkbox" {{ @array_key_exists($package, $role->permissions) ? 'checked' : '' }} value='1'>
                              <label class="custom-control-label" for="permissions_{{$package}}">{{ucfirst($package)}}</label>
                              <ul>
                                @foreach($modules as $module => $permissions)
                                  <li class="custom-control custom-checkbox">
                                    <input name="permissions[{{$package}}.{{$module}}]" class="custom-control-input" id="permissions_{{$package}}_{{$module}}" type="checkbox" {{ @array_key_exists($package. '.' . $module, $user->permissions) ? 'checked' : '' }} value='1'>
                                    <label class="custom-control-label" for="permissions_{{$package}}_{{$module}}">{{ucfirst($module)}}</label>
                                    <ul class="clearfix">
                                    @foreach($permissions as $permission => $value)
                                        <li style="float:left; margin-right: 10px;" class="custom-control custom-checkbox">
                                            <input name="permissions[]" class="custom-control-input" id="permissions_{{$package}}_{{$module}}_{{$permission}}" type="checkbox" {{ (!$user->hasPermission($package. '.' . $module . '.' . $permission)) ? : 'checked'}} value='{{$value}}'>
                                            <label class="custom-control-label" for="permissions_{{$package}}_{{$module}}_{{$permission}}">{{ucfirst($permission)}} </label>
                                        </li>
                                    @endforeach
                                    </ul>
                                  </li>
                                @endforeach
                              </ul>
                            <hr />
                        </li>
                    @endforeach
                    </ul>
                  </div>
            </div>
          </div>
          <div class="row">
            <div class='col-12'>
            @foreach($user->teams as $team)
              <div class="member" data-team='{{$team->id}}'>
                <div class="item">
                  <div class="inline-block name">{{$team->name}}</div>
                  <div class="inline-block role">{{$team->pivot->role}}</div>
                  <div class="inline-block pull-right">
                    @if($user->team_id == $team->id)
                      Current
                    @else
                      <a title="Change" class="red switch">Switch</a>
                    @endif
                  </div>
              </div>
            </div>
            @endforeach
          </div>
          </div> 
      </div> 

    <div class="app-entry-form-section" id="details">
        <div class="section-title">Details</div>
          <div class="row">
            <div class="col-12">
              {!! Form::radios('sex')
                            -> radios(trans('user::user.options.sex'))
                            -> label(trans('user::user.label.sex'))
                            -> inline() !!}
            </div>
            <div class="col-12">
              {!! Form::select('reporting_to')
                            -> options(trans('user::user.options.reporting_to'))
                            -> label(trans('user::user.label.reporting_to'))
                            -> placeholder(trans('user::user.placeholder.reporting_to')) !!}
            </div>
            <div class="col-12">
              {!! Form::select('department')
                            -> options(trans('user::user.options.department'))
                            -> label(trans('user::user.label.department'))
                            -> placeholder(trans('user::user.placeholder.department')) !!}
            </div>
            <div class="col-12">
              {!! Form::text('dob')
                            -> label(trans('user::user.label.dob'))
                            ->id('datetimepicker4')
                            -> placeholder(trans('user::user.placeholder.dob')) !!}
            </div>
            <div class="col-12">
              {!! Form::tel('phone')
                            -> label(trans('user::user.label.phone'))
                            -> placeholder(trans('user::user.placeholder.phone')) !!}
            </div>
            <div class="col-12">
              {!! Form::text('address')
                            -> label(trans('user::user.label.address'))
                            -> placeholder(trans('user::user.placeholder.address')) !!}
            </div>
            <div class="col-12">
              {!! Form::text('street')
                            -> label(trans('user::user.label.street'))
                            -> placeholder(trans('user::user.placeholder.street')) !!}
            </div>
            <div class="col-12">
              {!! Form::text('city')
                            -> label(trans('user::user.label.city'))
                            -> placeholder(trans('user::user.placeholder.city')) !!}
            </div>
            <div class="col-12">
              {!! Form::text('district')
                            -> label(trans('user::user.label.district'))
                            -> placeholder(trans('user::user.placeholder.district')) !!}
            </div>
            <div class="col-12">
              {!! Form::text('state')
                            -> label(trans('user::user.label.state'))
                            -> placeholder(trans('user::user.placeholder.state')) !!}
            </div>
            <div class="col-12">
              {!! Form::text('country')
                            -> label(trans('user::user.label.country'))
                            -> placeholder(trans('user::user.placeholder.country')) !!}
            </div>
            <div class="col-12">
              {!! Form::url('web')
                            -> label(trans('user::user.label.web'))
                            -> placeholder(trans('user::user.placeholder.web')) !!}
            </div>
            <div class="col-12">
              <label>Photo</label>
                        <div class='col-md-12 col-sm-12'>
                            {!!$user->files('photo')->url($user->getUploadUrl('photo'))->dropzone()!!}
                            {!!$user->files('photo')->editor()!!}
                        </div>
            </div>
          </div>
    </div> 
  </div>
  <div class="col-md-3">
    <aside class="app-create-steps">
    <h5 class="steps-header">Steps</h5>
      <div class="steps-wrap" id="steps_nav">
          <a class="step-item active" href="#contact"><span>1</span> Contact</a>
          <a class="step-item" href="#details"><span>2</span> Details</a>
      </div>
    </aside>
  </div>
</div>
</div>

<style type="text/css">
.item {
    border-bottom: #999 dashed 1px;
    padding: 0px 0px 5px 0px;
    margin: 5px 5px 0px 5px;
}
.item .red{
    color:red;
    cursor:pointer;
}
.inline-block {
    display: inline-block !important;
}
.name {
    width:40%;
}
.treeview {
  margin: 10px 0 0 0px;
}
.treeview ul { 
  list-style: none;
}

.treeview li label {
    font-weight: 500;
    margin-bottom: 2px;
}
.treeview hr {
    margin-top: 2px;
}
.treeview>ul>li>label {
    font-weight: 700;
}
</style>

<script type="text/javascript">


$(function() {
      $(".switch").click(function(e) {
        e.preventDefault();
        var formData = new FormData();
            formData.append('user_id', {{$user->id}});
            formData.append('team_id', $(this).parents('.member').data('team'));

        var url  = '{{guard_url('user/user/switch')}}';

        $.ajax( {
            url: url,
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            async: false,
            success:function(data, textStatus, jqXHR)
            {
                app.load($('#user-user-entry'), data.url);
            }
        });
    });

    $(".pwdedit").click(function(){
      $("#password").removeAttr('disabled');
    });

    $('input[type="checkbox"]').change(function(e) {

      var checked = $(this).prop("checked"),
          container = $(this).parent(),
          siblings = container.siblings();

      container.find('input[type="checkbox"]').prop({
        indeterminate: false,
        checked: checked
      });

      function checkSiblings(el) {

        var parent = el.parent().parent(),
            all = true;

        el.siblings().each(function() {
          return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
        });

        if (all && checked) {

          parent.children('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
          });

          checkSiblings(parent);

        } else if (all && !checked) {

          parent.children('input[type="checkbox"]').prop("checked", checked);
          parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
          checkSiblings(parent);

        } else {

          el.parents("li").children('input[type="checkbox"]').prop({
            indeterminate: true,
            checked: false
          });

        }
      }
      checkSiblings(container);
    });
    
});
</script>