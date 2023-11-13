
{{dd($permissions)}}
@foreach ($form['fields'] as $key => $fields)
    <div class="app-entry-form-section mb-10 pb-20" id="{!! $key !!}">
        <div class="section-title">{!! $form['groups'][$key]['name'] !!}</div>
        <div class="row">
            @foreach ($fields as $key => $field)
                <div class="col-{!! $field['col'] ?? '12' !!}">
                    {!! Form::input($field['key'])->apply($field)->mode($mode) !!}
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<input type="hidden" name="type" value="User">
<div class="app-entry-form-section mb-10 pb-20" id="{!! $key !!}">
    <div class="section-title">Permissions</div>
    <div class="row">
        <div class="col-12">
            <div class="treeview" style="height:250px;overflow:auto;">
                <ul>
                    @foreach ($permissions as $provider => $packages)
                        <li class="custom-control custom-checkbox" ">
                        <input name="main[{{ $package }}]" class="custom-control-input" id="permissions_{{ $package }}" type="checkbox" {{ @array_key_exists($package, $data['permissions']) ? 'checked' : '' }} value='1'>
                        <label class="custom-control-label" for="permissions_{{ $package }}">{{ ucfirst($package) }}</label>
                         @if (!empty($modules))
                            <ul>
                                @foreach ($packages as $package => $modules)
                                    <li class="custom-control custom-checkbox" style="margin-left:-40px;">
                                        <input name="sub[{{ $package }}.{{ $module }}]"
                                            class="custom-control-input"
                                            id="permissions_{{ $package }}_{{ $module }}" type="checkbox"
                                            {{ @array_key_exists($package . '.' . $module, $data['permissions']) ? 'checked' : '' }}
                                            value='1'>
                                        <label class="custom-control-label"
                                            for="permissions_{{ $package }}_{{ $module }}">{{ ucfirst($module) }}</label>
                                        @if (!empty($permissions))
                                            <ul class="clearfix" style="padding-left:0px;">
                                                @foreach ($permissions as $permission => $value)
                                                    <li class="custom-control custom-checkbox"
                                                        style="float:left; margin-right: 10px;">
                                                        <input name="permissions[]" class="custom-control-input"
                                                            id="permissions_{{ $package }}_{{ $module }}_{{ $permission }}"
                                                            type="checkbox"
                                                            {{ @array_key_exists($value, $data['permissions']) ? 'checked' : '' }}
                                                            value='{{ $value }}'>
                                                        <label class="custom-control-label"
                                                            for="permissions_{{ $package }}_{{ $module }}_{{ $permission }}">{{ ucfirst($permission) }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                    @endif
                    <hr />
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .treeview {
        margin: 10px 0 0 20px;
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
                    return all = ($(this).children('input[type="checkbox"]').prop("checked") ===
                        checked);
                });
                if (all && checked) {
                    parent.children('input[type="checkbox"]').prop({
                        indeterminate: false,
                        checked: checked
                    });
                    checkSiblings(parent);
                } else if (all && !checked) {
                    parent.children('input[type="checkbox"]').prop("checked", checked);
                    parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find(
                        'input[type="checkbox"]:checked').length > 0));
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
