<style type="text/css">
    .widget-user .widget-user-header {
        height: auto !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>
            Masters
            <small>Masters home</small>
          </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Masters</li>
          </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <div class="row">
                <div class="col-md-4">
                    @include('master::admin.master.partial.menu.master')
                </div>

                <div class="col-md-4">
                    @include('master::admin.master.partial.menu.location')
                </div>

                <div class="col-md-4">
                    @include('master::admin.master.partial.menu.project')
                </div>

        </div>
    </section>
</div>
