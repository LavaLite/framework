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
            <button  class="btn btn-danger btn-simple task-delete"  data-action="DELETE" data-load-to='#{!!$value["status"]!!}_list'  data-href='{{ guard_url('task/task') }}/{{$value->getRouteKey()}}'>
                <i class="material-icons">close</i>
            </button>
        </div>
    </li>
    @empty
    @endif
</ul>

<script type="text/javascript">  
    $('input[name="task"]').val('');
    $(".task-edit").click(function(){
        var id = $(this).parent().parent().attr('id');
        $('#modal-task .modal-content').load('{{guard_url('task/task')}}'+ '/' + id + '/' + 'edit');
        $('#modal-task').show();
    });  

    $(".sortable-list").sortable({
        connectWith: ".connectList"
    }).disableSelection();

    $( ".sortable-list" ).on( "sortreceive", function( event, ui ) {
        var status = $(this).attr('id');
        var id     = ui.item.attr('id');

        var formURL  = "{{ guard_url('task/task')}}"+"/"+id;
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

