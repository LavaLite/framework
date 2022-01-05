<div class="custom-control custom-switch">
    <input type="hidden" id="{!!$id!!}_hidden" value="0" name="{!!$name!!}">
    <input type="checkbox" class="custom-control-input" id="{!!$id!!}_switch" value="1" name="{!!$name!!}" {!!$attributes['element.attribute']!!}  @if($value == 1 )checked='checked'@endif>
    <label class="custom-control-label" for="{!!$id!!}_switch">{!!$placeholder!!}</label>
</div>
