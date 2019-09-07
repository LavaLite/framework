<div class='row'>
    <div class='col-md-4 col-sm-6'>
            {!! Form::text('name')
            -> label(trans('user::team.label.name'))
            -> required()
            -> placeholder(trans('user::team.placeholder.name'))!!}
    </div>
    <div class='col-md-4 col-sm-6'>
        <label> Members </label>
        <div class='row'>
            <div class='col-md-5 col-sm-6'>
                {!! Form::select('user_id')
                -> options(App\User::all()->pluck('name', 'id')->sortBy('name'))
                -> label(trans('user::team.label.user_id'))
                -> placeholder(trans('user::team.placeholder.user_id'))
                ->raw()!!}
            </div>
            <div class='col-md-5 col-sm-6'>
                {!! Form::select('role')
                -> options(trans('user::team.options.role'))
                -> label(trans('user::team.label.role'))
                -> placeholder(trans('user::team.placeholder.role'))
                -> raw()!!}
            </div>
            <div class='col-md-2 col-sm-6'>
                <button class="btn btn-primary pull-right" id="attach">Add</button>
            </div>
        </div>

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
