<ul class="media-list scroll-content sortable-list connectList ui-sortable mn pn" id="{!!$status!!}">
    @forelse($tasks as $key => $value)
    <li class="media b-bl {!!@$value['priority']!!}  {!!@$value['status']!!}" id="{!!@$value->getRouteKey()!!}">
        <div class="task-cont">
            <div class="media-left">
                <span class="icon"><i class="ion-checkmark-round"></i></span>
            </div>
            <div class="media-body">
                <span class="name">{!!@$value['task']!!}</span></span>
                <span class="time">{!! format_date(@$value['created_at']) !!}</span>
            </div>
        </div>
        <div class="task-actions">
            <button class="btn btn-info btn-simple task-edit" data-toggle="modal" data-target="#modal-task">
                <i class="material-icons">edit</i>
            </button>
            <button  class="btn btn-danger btn-simple task-delete"  data-action="DELETE" data-load-to='#{!!$value["status"]!!}_list'  data-href='{{ trans_url($guard.'/task/task') }}/{{$value->getRouteKey()}}'>
                <i class="material-icons">close</i>
            </button>
        </div>
    </li>
    @empty
    @endif
</ul>



<!-- <ul class="sortable-list connectList agile-list ui-sortable" id="{!!$status!!}">
    @forelse($tasks as $key => $value)       
        <li class="{!!@$value['priority']!!}  {!!@$value['status']!!}" id="{!!@$value->getRouteKey()!!}">
            {!!@$value['task']!!}
            <div class="task-link-btn">
                <a class="task-edit m-r-5 btn-xs btn-primary" data-toggle="modal" data-target="#modal-task">
                    <i class="fa fa-pencil"></i>
                </a>
                <abutton class="task-delete btn-xs btn-danger" data-action="DELETE" data-load-to='#{!!$value["status"]!!}_list'  data-href='{{ trans_url($guard.'/task/task') }}/{{$value->getRouteKey()}}' ><i class="fa fa-trash"></i></a>
            </div> 
            <div class="agile-detail">
                <i class="fa fa-clock-o"></i> {!! format_date(@$value['created_at']) !!}
                
            </div>
        </li>
    @empty
    @endif
</ul> -->

<script type="text/javascript">  
    $('input[name="task"]').val('');
    $(".task-edit").click(function(){
        var id = $(this).parent().parent().attr('id');
        $('#modal-task .modal-content').load('{{trans_url($guard.'/task/task')}}'+ '/' + id + '/' + 'edit');
        $('#modal-task').show();
    });  

    $(".sortable-list").sortable({
        connectWith: ".connectList"
    }).disableSelection();

    $( ".sortable-list" ).on( "sortreceive", function( event, ui ) {
        var status = $(this).attr('id');
        var id     = ui.item.attr('id');

        var formURL  = "{{ Trans::to($guard.'/task/task')}}"+"/"+id;
        $.ajax( {
            url: formURL,
            type: 'PUT',
            data: {'status': status},
            success:function(data, textStatus, jqXHR)
            {
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });
    }); 

</script>

