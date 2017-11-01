<ul class="dropdown-menu  notification">
  <li class="header">  You have {!!Message::count('Inbox', null, 1)!!} messages</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <div class="slimScrollDiv" >
      <ul class="menu" >
      <div class="slim-scroll">
      @forelse(Message::list('Inbox', null, 1) as $key => $value)
       <li>
           <a href="{!!guard_url('message/message')!!}">
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
  </div>
  </li>
  <li class="footer"><a href="{{guard_url('message/message')}}">See All Messages</a></li>
</ul>
