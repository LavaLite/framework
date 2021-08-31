@if($isInputGroup)
<div class="input-group mb-3">
  @if(is_array($prepend))
  <div class="input-group-prepend">
    @foreach($prepend as $val)
    <span class="input-group-text">{{$val}}</span>
    @endforeach
  </div>
  @endif
  <input type="{{$type}}" class="{!!$attributes['element.class'] ?: 'form-control'!!}" id="{{$id}}" value="{{$value}}" name="{{$name}}" placeholder="{{$placeholder}}" {!!$attributes['element.attribute']!!}>
  @if(is_array($append))
  <div class="input-group-append">
    @foreach($append as $val)
    <span class="input-group-text">{{$val}}</span>
    @endforeach
  </div>
  @endif
</div>
@else
<input type="{{$type}}" class="{!!$attributes['element.class'] ?: 'form-control'!!}" id="{{$id}}" value="{{$value}}" name="{{$name}}" placeholder="{{$placeholder}}" {!!$attributes['element.attribute']!!}>
@endif
