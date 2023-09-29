@foreach ($form['fields'] as $key => $fields)
    <div class="app-entry-form-section mb-10 pb-20" id="{!! $key !!}">
        <div class="section-title">{!! trans('team::team.groups.' . $key) !!}</div>
        <div class="row">
            @foreach ($fields as $key => $field)
                <div class="col-{!! $field['col'] ?? '12' !!}">
                    {!! Form::input($field['key'])->apply($field)->mode($mode) !!}
                </div>
            @endforeach
        </div>
    </div>
@endforeach

@if ($data['meta']['exists'])
    <div class="app-entry-form-section mb-10 pb-20" id="teams">
        <div class="section-title">{!! trans('team::team.groups.members') !!}</div>
        @if($mode=='edit')
        <div class="row">
            <div class='col-7'>
                {!! Form::select('user_id')->options(User::options('user'))->label(trans('team::team.label.user'))->placeholder(trans('team::team.placeholder.user')) !!}
            </div>
            <div class='col-3'>
                {!! Form::select('level')->options(trans('team::team.options.level'))->label(trans('team::team.label.level'))->placeholder(trans('team::team.placeholder.level')) !!}
            </div>
            <div class='col-2'>
                <label class="mt-5">&nbsp;</label>
                <button class="btn btn-primary" id="attach">Add</button>
            </div>
        </div>
        @endif

        <br />
        <div class="row">
            <div class='col-12'>
                <div class="members">
                    @if (isset($data['users']) && is_array($data['users']))
                        @foreach ($data['users'] as $user)
                            <div class="member" data-user='{{ $user['id'] }}'>
                                <div class="item">
                                    <div class="row">
                                        <div class="inline-block col-7">{{ $user['name'] }}</div>
                                        <div class="inline-block col-3">{{ $user['level_name'] }}</div>
                                        <div class="inline-block pull-right col-2">
                                            @if($mode=='edit')
                                                <a title="Delete" class="red detach"><i class="fa fa-trash"></i></a>                                                
                                            @else
                                                <a title="Delete" class="text-secondary"><i class="fa fa-trash"></i></a>                                                
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
<style>
    .item {
        border-bottom: #999 dashed 1px;
        padding: 0px 0px 5px 0px;
        margin: 5px 5px 0px 5px;
    }

    .item .red {
        color: red;
        cursor: grab;
    }

    .inline-block {
        display: inline-block !important;
    }
</style>
<script>
    $(document).ready(function() {
        $(".delete").click(function(e) {
            e.preventDefault();
            $(this).parents('.member').remove()
        });
        $("#attach").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('user_id', $('#user_id').val());
            formData.append('role', $('#role').val());
            formData.append('level', $('#level').val());
            var url = '{{ guard_url('team/team/attach') }}/{{ $data['id'] }}';
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                async: false,
                success: function(data, textStatus, jqXHR) {
                    app.load($('#teams-team-entry'), data.url);
                }
            });
        });
        $(".detach").click(function(e) {
            e.preventDefault();
            $(this).parents('.member').data('user')
            var formData = new FormData();
            formData.append('user_id', $(this).parents('.member').data('user'));
            var url = '{{ guard_url('team/team/detach') }}/{{ $data['id'] }}';
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                async: false,
                success: function(data, textStatus, jqXHR) {
                    app.load($('#teams-team-entry'), data.url);
                }
            });
        });
    });
</script>
