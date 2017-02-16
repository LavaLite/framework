<div class="modal fade" id="popupTeam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header" style="margin-top: 70px;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h3 class="modal-title team-title">Current Team</h3>
        </div>
        <div class="modal-body" style="min-height:220px;">

            <table class="table  table-stripped data-table mt10"  >
                <tbody>
                  @if(!empty(user('admin.web')->team))   
                    @foreach(user('admin.web')->team as $key => $team)
                      @if($team->id == user('admin.web')->team_id)
                        <tr id="row-{!!@$team->id!!}">
                          <td><img src="{!!url(@$team->defaultImage('xs','logo'))!!}" width="30" height="30"></td>
                          <td><a class="text-danger" title="Current Team"><b>{!! @$team->name !!}</b></a></td>
                        </tr>
                      @else
                        <tr id="row-{!!@$team->id!!}">
                          <td><img src="{!!url(@$team->defaultImage('xs','logo'))!!}" width="30" height="30"></td>
                          <td><a class="text-primary btn-change-team" title="Change" data-id="{!! @$team->id !!}">{!! @$team->name !!}</a></td>
                        </tr>
                      @endif    
                    @endforeach
                  @endif
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

    </div>          
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $(".btn-change-team").click(function(){
        var formData = new FormData();
        formData.append('team_id', $(this).data('id'));
        $.ajax( {
            url: "{{trans_url('/admin/user/user/change/team')}}",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success:function(data, textStatus, jqXHR)
            {
               location.reload();
            }
        });

    });

  });
</script>


<style>
.modal-backdrop.fade {
    display: none !important;
}
.team-title {
    color: #000 !important;
    font-weight: 400;
}
.text-danger {
    color: #a94442 !important;
}
.text-primary {
    color: #337ab7 !important;
}
</style>