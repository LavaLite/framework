@foreach($form as $key => $fields)
<div class="app-entry-form-section mb-10 pb-20" id="{!!$key!!}">
    <div class="section-title">{!!$key!!}</div>
    <div class="row">
        @foreach($fields as $key => $field)
        <div class="col-{!!$field['col'] ?? '12'!!}">
            {!!
            Form::input($key)
            ->apply($field)
            ->mode($mode)
            !!}
        </div>
        @endforeach
    </div>
</div>
@endforeach
