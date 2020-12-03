
<div class="container-fluid">
  <div class="row">
    <div class='col-9'>
      <div class="app-entry-form-section" id="team">
        <div class="section-title">Team</div>
          <div class="row">
            <div class="col-12">
               {!! Form::text('name')
            -> label(trans('team::team.label.name'))
            -> required()
            -> placeholder(trans('team::team.placeholder.name'))!!}
            </div>
            <div class='col-12'>
                <div class="section-title">Members</div>
                {!! Form::select('user_id')
                -> options(Litepie\Team\Models\Team::all()->pluck('name', 'id')->sortBy('name'))
                -> label(trans('team::team.label.user_id'))
                -> placeholder(trans('team::team.placeholder.user_id'))
                !!}
            </div>
            <div class='col-12'>
               {!! Form::select('role')
                -> options(trans('team::team.options.role'))
                -> label(trans('team::team.label.role'))
                -> placeholder(trans('team::team.placeholder.role'))
                !!}
            </div> 
            <div class='col-12'>
                <button class="btn btn-primary pull-right" id="attach">Add</button>
            </div>
            <div class='col-12'>
                <div class="members">
                @foreach ($team->users as $user)
                    <div class="member" data-user='{{$user->id}}'>
                        <div class="item">
                            <div class="inline-block name">{{$user->name}}</div>
                            <div class="inline-block role">{{$user->pivot->role}}</div>
                            <div class="inline-block pull-right">
                                <a title="Delete" class="red detach"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>

          </div>  
      </div>
  </div>
  <div class="col-md-3">
    <aside class="app-create-steps">
    <h5 class="steps-header">Steps</h5>
      <div class="steps-wrap" id="steps_nav">
          <a class="step-item" href="#team"><span>1</span> Team</a>
      </div>
    </aside>
  </div>
</div>
</div>
<style>
.item {
    border-bottom: #999 dashed 1px;
    padding: 0px 0px 5px 0px;
    margin: 5px 5px 0px 5px;
}
.item .red{
    color:red;
    cursor:grab;
}
.inline-block {
    display: inline-block !important;
}
.name {
    width:40%;
}
</style>
<script>
    $(document).ready(function(){
        $(".delete").click(function(e) {
            e.preventDefault();
            $(this).parents('.member').remove()
        });
        $("#attach").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('team_id', {{$team->id}});
            formData.append('user_id', $('#user_id').val());
            formData.append('role', $('#role').val());

            var url  = '{{guard_url('user/team/attach')}}';

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
                    app.load($('#teams-team-entry'), data.url);
                }
            });
        });
        $(".detach").click(function(e) {
            e.preventDefault();
            $(this).parents('.member').data('user')
            var formData = new FormData();
            formData.append('team_id', {{$team->id}});
            formData.append('user_id', $(this).parents('.member').data('user'));

            var url  = '{{guard_url('user/team/detach')}}';

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
                    app.load($('#teams-team-entry'), data.url);
                }
            });
        });
    });
</script>
