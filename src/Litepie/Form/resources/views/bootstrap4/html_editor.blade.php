@if($mode == 'show')
<div class="form-element">
{!!$value!!}
</div>
@else
<textarea class="{!!$attributes['element.class'] ?: 'form-control html-editor'!!}" id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}" {!!$attributes['element.attribute']!!}>{{$value}}</textarea>
@endif