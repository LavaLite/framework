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
            {!! trans('master::master.name') !!}
            <small>Masters home</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!}</a></li>
            <li class="active">{!! trans('master::master.name') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @foreach($groups as $key => $group)
            <div class="col-md-4">
                @include('master::menu', compact('group', 'key'))
            </div>
            @endforeach
        </div>
    </section>
</div>
