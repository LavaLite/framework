<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        @section('heading') Heading @show
        </h1>
        @section('breadcrumb') Breadcrumb @show
    </section>
    <!-- Main content -->
    <section class="content">
    @section('entry') 
        <div class="nav-tabs-custom" id='entry'>
        </div>
    @show
    <!-- Default box -->
    <div class="nav-tabs-custom">
        <div class="box-body">
            @section('content') Content @show
        </div>
    </div>
    </section>
</div>
@section('script')

@show

@section('style')

@show 