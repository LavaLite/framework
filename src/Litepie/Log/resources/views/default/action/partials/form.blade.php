@foreach($form['fields'] as $key => $fields)
<div class="app-entry-form-section mb-10 pb-20" id="{!!$key!!}">
    <div class="section-title">{!!$form['groups'][$key]['name']!!}</div>
    <div class="row">
        @foreach($fields as $key => $field)
        <div class="col-{!!$field['col'] ?? '12'!!}">
            {!!
            Form::input($field['key'])
            ->apply($field)
            ->mode($mode)
            !!}
        </div>
        @endforeach
    </div>
</div>
@endforeach
