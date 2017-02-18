<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{!!user('admin.web')->picture!!}" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>{!!user('admin.web')->name!!}</p>
        <a href="#" data-toggle="modal" data-target="#popupTeam"><i class="fa fa-circle text-success"></i> {!!@user('admin.web')->teams->name!!}</a>
        @include('vuser::admin.team.teams')
      </div>
    </div>
    <!-- search form -->
   
     <ul class="sidebar-settings">
        <li ><a href="{!!url('admin/profile')!!}"><i class="fa fa-user "></i> Profile</a></li>
        <li ><a href="{!!url('logout?role=admin.web')!!}"><i class="fa fa-power-off"></i> Logout</a></li>
    </ul>
    
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      {!!Menu::menu('admin', 'menu::menu.admin')!!}
      <li class="header">Masters</li>
      <li><a href="{{ URL::to('admin/settings/setting') }}"><i class="fa fa-sliders text-red"></i> <span>Settings</span></a></li>
      <li><a href="{{ URL::to('admin/masters') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Masters</span></a></li>
      <li><a href="{{ URL::to('admin/reports') }}"><i class="fa fa-bar-chart text-aqua"></i> <span>Reports</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
