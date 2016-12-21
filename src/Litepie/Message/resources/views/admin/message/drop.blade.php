<ul class="dropdown-menu  notification">
  <li class="header">  You have {!!Message::count('Inbox')!!} messages</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <div class="slimScrollDiv" >
      <ul class="menu" >
      <div id="slimScroll">
      @forelse(Message::unread() as $key => $value)
       <li>
           <a href="{!!URL::to('/admin/message/message')!!}">
               <div class="pull-left">
                    <img src="{!!@$value['user']->picture!!}"  class="img-circle img-responsive" alt="User Image" />
               </div>
               <h4>
                   {!!@$value->user->name!!}
                   <br>
                  <small class="">
                       <i class="fa fa-clock-o">
                       </i>
                       <time class="timeago" datetime="{!!@$value['created_at']!!}"></time>
                        <p class="">{!!@$value['subject']!!}</p>
                   </small>
               </h4>
              
               
           </a>
       </li>
       <!-- end message -->
       @empty
       @endif
      </div>
    </ul>
  </div><!-- <div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div> -->
  </li>
  <li class="footer"><a href="{{trans_url('/admin/message/message')}}">See All Messages</a></li>
</ul>
<script type="text/javascript">
$(function(){
$('#slimScroll').slimScroll({
        color: '#dd4b39',
        height: '100%',
        alwaysVisible: true
    });
})
      
</script>