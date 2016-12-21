@forelse($calendars['data'] as $key =>$value)
<div class="external-event" style="background-color:{!!@$value['color']!!};" id="{!!@$value['id']!!}">
    {!!@$value['title']!!}
</div>
@empty
@endif
<div class="checkbox checkbox-danger">
    <input type="checkbox" id="drop-remove"/>
    <label for="drop-remove">remove after drop</label>                            
</div>