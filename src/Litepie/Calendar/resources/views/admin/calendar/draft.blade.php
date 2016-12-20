

@forelse($calendars as $key =>$value)
    <div class="external-event " style="background-color:{!!@$value['color']!!};" id="{!!@$value->getRouteKey()!!}">
        {!!@$value['title']!!}
    </div>
@empty
@endif
 <div class="checkbox-inline pull-left pln mt10 ">
                                <input id="drop-remove" class="lavalite" type="checkbox" > 
                                <label for="drop-remove"> <span class="ml10">remove after drop</span></label>
</div>                
<script type="text/javascript">
    $(function(){
            function ini_events(ele) {
                ele.each(function () {
                    var eventObject = {
                        title: $.trim($(this).text()), // use the element's text as the event title
                        id: $.trim($(this).attr('id')) // use the element's text as the event title
                    };
                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);
                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });
                });
            }
        ini_events($('#external-events div.external-event'));
    })
</script>