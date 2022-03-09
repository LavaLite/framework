@if($mode == 'show')
<div class="html-control">
{!!$value!!}
</div>
@else
<textarea class="{!!$attributes['element.class'] ?: 'form-control'!!} html-editor" id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}" {!!$attributes['element.attribute']!!}>{{$value}}</textarea>
@endif
<style>
.html-control {
    border-radius: 6px;
    border-color: #dde2ec;
    font-size: 14px;
    min-height: 35px;
    background-color: #f4f5f8 !important;
    opacity: 0.8 !important;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    color: #495057;
    display: block;
    font-weight: 400;
    height: 300px;
    line-height: 1.5;
    padding: .375rem .75rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 100%;
    overflow-y: scroll;
}

</style>