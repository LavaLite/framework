
<div class="container-fluid">
  <div class="row">
    <div class='col-9'>
      <div class="app-entry-form-section" id="role">
        <div class="section-title">Role</div>
          <div class="row">
            <div class="col-12">
               {!! Form::text('name')
                -> label(trans('roles::role.label.name'))
                -> required()
                -> placeholder(trans('roles::role.placeholder.name'))!!}
            </div>
            <div class='col-12'>
                {!! Form::text('slug')
                -> label(trans('roles::role.label.slug'))
                -> required()
                -> placeholder(trans('roles::role.placeholder.slug'))!!}
            </div>
            <div class='col-12'>
                {!! Form::text('description')
                -> label(trans('roles::role.label.description'))
                -> placeholder(trans('roles::role.placeholder.description'))!!}
            </div>
            <div class='col-12'>
                {!! Form::numeric('level')
                -> label(trans('roles::role.label.level'))
                -> placeholder(trans('roles::role.placeholder.level'))!!}
            </div> 
          </div>  
      </div>
      <div class="app-entry-form-section" id="permissions">
        <div class="section-title">Permissions</div>
          <div class="row">
            <div class='col-md-12 col-sm-12'>
              <div class="treeview"  style="height:250px;overflow:auto;">
                <ul>
                    @foreach($permissions as $package => $modules)
                        <li class="custom-control custom-checkbox">
                        <input name="main[{{$package}}]" class="custom-control-input" id="permissions_{{$package}}" type="checkbox" {{ @array_key_exists($package, $role->permissions) ? 'checked' : '' }} value='1'>
                        <label class="custom-control-label" for="permissions_{{$package}}">{{ucfirst($package)}}</label>
                        <ul>
                        @foreach($modules as $module => $permissions)
                            <li class="custom-control custom-checkbox">
                            <input name="sub[{{$package}}.{{$module}}]" class="custom-control-input" id="permissions_{{$package}}_{{$module}}" type="checkbox" {{ @array_key_exists($package. '.' . $module, $role->permissions) ? 'checked' : '' }} value='1'>
                            <label class="custom-control-label" for="permissions_{{$package}}_{{$module}}">{{ucfirst($module)}}</label>
                                <ul class="clearfix">
                                @foreach($permissions as $permission => $value)
                                    <li class="custom-control custom-checkbox" style="float:left; margin-right: 10px;">
                                        <input name="permissions[]" class="custom-control-input" id="permissions_{{$package}}_{{$module}}_{{$permission}}" type="checkbox" {{ (!$role->hasPermission($package. '.' . $module . '.' . $permission)) ? : 'checked'}} value='{{$value}}'>
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
      </div>
  </div>
  <div class="col-md-3">
    <aside class="app-create-steps">
    <h5 class="steps-header">Steps</h5>
      <div class="steps-wrap" id="steps_nav">
          <a class="step-item active" href="#role"><span>1</span>Role</a>
          <a class="step-item" href="#permissions"><span>2</span> Permissions</a>
      </div>
    </aside>
  </div>
</div>
</div>
<style type="text/css">

.treeview {
  margin: 10px 0 0 20px;
}
.treeview ul { 
  list-style: none;
  margin: 5px 10px;
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