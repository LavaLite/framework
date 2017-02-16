<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#notes" data-toggle="tab" aria-expanded="false" data-field="notes">Add memers &nbsp; </a></li>
  </ul>
  <div class="tab-content padding-top-10">
    <input type="hidden" name="notes" value="">
    <div class="tab-pane active" id="notes">
      <div class="row ">
          <div style="height: 285px; overflow-y: auto;" class="form-control p-6 margin-top-10" id="show-notes">
            <div class="col-md-12 col-xs-12 mt10">

              <div class='col-md-2 col-sm-4 mt10'>
                <label>Add here : </label>
              </div>
              <div class='col-md-4 col-sm-3'>
                  {!! Form::select('new_member')
                 -> options(User::agents())
                 -> placeholder(trans('user::team.placeholder.member'))
                 -> required()
                 -> raw()!!}
              </div>
              <div class='col-md-4 col-sm-3'>
                {!! Form::select('reporting_to')
                 -> options(User::reportingTo($team->id))
                 -> placeholder(trans('user::team.placeholder.reporting_to'))
                 -> required()
                 -> raw()!!}
              </div>
              <div class='col-md-2 col-sm-2'>
                <a type="button" class="btn btn-danger" id="btn-save-member">Save</a>
              </div>
            </div>
            <div class="col-md-12 col-xs-12">

              <table class="table  table-stripped data-table mt10"  >
                <thead class="list_head">
                  <tr>
                    <th>Sl No.</th>
                    <th>Member</th>
                    <th>Reporting To</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="list-notes">
                  @if(!empty($members))   
                    @foreach($members as $key => $value)
                    <tr id="row-{!!$key!!}">
                      <td>{!!$key+1!!}</td>
                      <td>{!! @$value->name !!}</td>
                      @if($value->pivot->reporting_to == 0)
                        <td>-</td>
                        <td><a class="text-danger" title="Remove" data-id="{!! @$value->id !!}" style="cursor:not-allowed;"><i class="fa fa-trash"></i></a></td>
                      @else
                        <td>{!! User::findUser(@$value->pivot->reporting_to)->name !!}</td>
                        <td><a class="text-danger btn-remove" title="Remove" data-id="{!! @$value->id !!}"><i class="fa fa-trash"></i></a></td>
                      @endif
                    </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $("#btn-save-member").click(function(){
        if($('#reporting_to').val() == null || $('#new_member').val() == null) {
            toastr.error('Please enter valid information.', 'Error');
            $('#reporting_to, #new_member').css('border','1px solid red');
            return false;
        }

        var formData = new FormData();
        formData.append('reporting_to', $('#reporting_to').val());
        formData.append('user_id', $('#new_member').val());

        $.ajax( {
            url: "{{trans_url('admin/user/team/add/member')}}/{{$team->getRouteKey()}}",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success:function(data, textStatus, jqXHR)
            {
                console.log(data);
                $('#user-team-entry').load( data.redirect);
            }
        });

    });

   
    $('.btn-remove').click(function(){
        var formData = new FormData();
        formData.append('user_id', $(this).data('id'));

        $.ajax( {
            url: "{{trans_url('admin/user/team/remove/member')}}/{{$team->getRouteKey()}}",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success:function(data, textStatus, jqXHR)
            {
                $('#user-team-entry').load( data.redirect);
            }
        });
    });

  });
</script>