<style type="text/css">
    .widget-user .widget-user-header {
        height: auto !important;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    @include('master::menu')
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div id='masters-entry'>
                    @include('master::master')
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
var module_link = "{{guard_url('master')}}";
</script>