@foreach ($form['fields'] as $key => $fields)
    <div class="app-entry-form-section mb-10 pb-20" id="{!! $key !!}">
        <div class="section-title">{!! $form['groups'][$key]['name'] !!}</div>
        <div class="row">
            @foreach ($fields as $key => $field)
                <div class="col-{!! $field['col'] ?? '12' !!}">
                    {!! form()->input($field['key'])->apply($field)->mode($mode) !!}
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
            <div class="treeview">

                @foreach ($permissions as $provider => $packages)
                    <div class="custom-control custom-checkbox">
                        <div class="form-check">
                            <input name="main[{{ $provider }}]" class="form-check-input"
                                id="permissions_{{ $provider }}" type="checkbox"
                                {{ @array_key_exists($provider, $data['permissions']) ? 'checked' : '' }}
                                value='1'>
                            <label class="form-check-label"
                                for="permissions_{{ $provider }}">{{ ucfirst($provider) }}</label>
                        </div>
                        @if (!empty($packages))
                            @foreach ($packages as $package => $modules)
                                <div class="custom-control custom-checkbox" style="padding-left:25px;">
                                    <div class="form-check">
                                        <input name="sub[{{ $provider }}.{{ $package }}]"
                                            class="form-check-input"
                                            id="permissions_{{ $provider }}_{{ $package }}" type="checkbox"
                                            {{ @array_key_exists($provider . '.' . $package, $data['permissions']) ? 'checked' : '' }}
                                            value='1'>
                                        <label class="form-check-label"
                                            for="permissions_{{ $provider }}_{{ $package }}">{{ ucfirst($package) }}</label>
                                    </div>

                                    @if (!empty($modules))
                                        @foreach ($modules as $module => $perms)
                                            <div class="custom-control custom-checkbox" style="padding-left: 25px;">
                                                <div class="form-check">
                                                    <input
                                                        name="sub[{{ $provider }}.{{ $package }}.{{ $module }}]"
                                                        class="form-check-input"
                                                        id="permissions_{{ $provider }}_{{ $package }}_{{ $module }}"
                                                        type="checkbox"
                                                        {{ @array_key_exists(@$value['slug'], $data['permissions']) ? 'checked' : '' }}
                                                        value='{{ @$value['slug'] }}'>
                                                    <label class="form-check-label"
                                                        for="permissions_{{ $provider }}_{{ $package }}_{{ $module }}">{{ ucfirst($module) }}</label>
                                                </div>
                                                @if (!empty($perms))
                                                    <div class="custom-control custom-checkbox" style="padding-left: 25px;">
                                                        @foreach ($perms as $p => $value)
                                                            <div class="form-check form-check-inline">
                                                                <input name="permissions[]" class="form-check-input"
                                                                    id="permissions_{{ @$value['slug'] }}"
                                                                    type="checkbox"
                                                                    {{ @array_key_exists(@$value['slug'], $data['permissions']) ? 'checked' : '' }}
                                                                    value='{{ @$value['slug'] }}'>
                                                                <label class="form-check-label"
                                                                    for="permissions_{{ @$value['slug'] }}">{{ @$value['name'] }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        @endif
                        <hr />
                    </div>
                @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .treeview {
    }

    .treeview ul {

    }

    .treeview hr {
        margin-top: 2px;
    }
</style>

<script type="text/javascript">
$(document).ready(function() {
    $('input[type="checkbox"]').change(function() {
        var checked = $(this).prop("checked"),
            container = $(this).closest(".custom-control"),
            children = container.find('input[type="checkbox"]');

        // Toggle all child checkboxes
        children.prop({
            indeterminate: false,
            checked: checked
        });

        function checkSiblings(el) {
            var parentContainer = el.closest(".custom-control").parent().closest(".custom-control"),
                parentCheckbox = parentContainer.children('.form-check').find('input[type="checkbox"]'),
                allChecked = true,
                allUnchecked = true;

            el.siblings(".custom-control").each(function() {
                var siblingCheckbox = $(this).children('.form-check').find('input[type="checkbox"]');
                if (siblingCheckbox.prop("checked")) {
                    allUnchecked = false;
                } else {
                    allChecked = false;
                }
            });

            if (allChecked) {
                parentCheckbox.prop({
                    indeterminate: false,
                    checked: true
                });
            } else if (allUnchecked) {
                parentCheckbox.prop({
                    indeterminate: false,
                    checked: false
                });
            } else {
                parentCheckbox.prop({
                    indeterminate: true,
                    checked: false
                });
            }

            if (parentContainer.length) {
                checkSiblings(parentContainer);
            }
        }

        checkSiblings(container);
    });
});

</script>
