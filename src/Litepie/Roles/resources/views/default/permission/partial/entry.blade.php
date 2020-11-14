
<div class="container-fluid">
  <div class="row">
    <div class='col-9'>
      <div class="app-entry-form-section" id="permissions">
        <div class="section-title">Permission</div>
          <div class="row">
            <div class="col-12">
               {!! Form::text('name')
                       -> required()
                       -> label(trans('roles::permission.label.name'))
                       -> placeholder(trans('roles::permission.placeholder.name'))!!}
            </div>
            <div class='col-12'>
                {!! Form::text('slug')
                       -> required()
                       -> label(trans('roles::permission.label.slug'))
                       -> placeholder(trans('roles::permission.placeholder.slug'))!!}
            </div>
            <div class='col-12'>
                {!! Form::text('description')
                       -> label(trans('roles::permission.label.description'))
                       -> placeholder(trans('roles::permission.placeholder.description'))!!}
            </div> 
          </div>  
      </div>
  </div>
  <div class="col-md-3">
    <aside class="app-create-steps">
    <h5 class="steps-header">Steps</h5>
      <div class="steps-wrap" id="steps_nav">
          <a class="step-item" href="#permissions"><span>1</span> Permissions</a>
      </div>
    </aside>
  </div>
</div>
</div>
