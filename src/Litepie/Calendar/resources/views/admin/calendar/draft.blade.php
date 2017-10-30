

@foreach($calendars as $key =>$value)
    <div class="external-event {!!@$value['color']!!}" id="{!!@$value->getRouteKey()!!}">
        {!!@$value['title']!!}
    </div>
@endforeach
<div class="checkbox checkbox-danger">
    <input type="checkbox" id="drop-remove"/>
    <label for="drop-remove">Remove after drop</label>                            
</div>
