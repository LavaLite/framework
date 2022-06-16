@if (is_array($value))
{{Arr::get($value, 'name', Arr::get($value, 'value'))}}
@else
{{@$value}}
@endif