    <select  class="{!!$attributes['element.class'] ?: 'form-control'!!}" id="{{$id}}" name="{{$name}}" {!!$attributes['element.attribute']!!}>
        @if ($placeholder)
        <option disabled>{{$placeholder}}</option>
        @endif
        @forelse ($options as $option)
        <option value="{{$option[$select_value]}}" {!!$option['selected'] ? 'selected="selected"' : ''!!}>{{$option[$select_text]}}</option>
        @empty
        @endforelse
    </select>