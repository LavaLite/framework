@include('public::notifications')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card-box widget-icon bg-success">
            <div>
                <i class="icon-speech text-white ">
                </i>
                <div class="wid-icon-info">
                    <p class="text-white m-b-5 font-13 text-uppercase">
                        My Blogs
                    </p>
                    <h4 class="m-t-0 m-b-5 counter text-white">
                        {{Blog::count('blog')}}
                    </h4>
                    <small class="text-white "><b></b></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card-box widget-icon bg-danger">
            <div>
                <i class="icon-user text-white">
                </i>
                <div class="wid-icon-info">
                    <p class="text-white m-b-5 font-13 text-uppercase">
                        Discussions
                    </p>
                    <h4 class="m-t-0 m-b-5 counter text-white">
                        {{Forum::count()}}
                    </h4>
                    <small class="text-white "><b></b></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card-box widget-icon bg-pink">
            <div>
                <i class="icon-book-open text-white">
                </i>
                <div class="wid-icon-info">
                    <p class="text-white m-b-5 font-13 text-uppercase">
                        News
                    </p>
                    <h4 class="m-t-0 m-b-5 counter text-white">
                        {{News::count()}}
                    </h4>
                    <small class="text-white "><b></b></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card-box widget-icon bg-purple">
            <div>
                <i class="icon-picture text-white">
                </i>
                <div class="wid-icon-info">
                    <p class="text-white m-b-5 font-13 text-uppercase">
                        My Gallery
                    </p>
                    <h4 class="m-t-0 m-b-5 counter text-white">
                        {{Gallery::count()}}
                    </h4>
                    <small class="text-white "><b></b></small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-7 col-lg-7">
        <div class="dashboard-content">
            <div class="panel panel-color panel-purple">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4 class="panel-title" style="font-size: 16px;">
                                Calendar
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {!!Calendar::gadget('user.calendar.gadget')!!}
                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <a class="btn btn-sm btn-danger waves-effect waves-light text-uppercase" href="{!! trans_url('user/calendar/calendar') !!}">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="dashboard-content">
            <div class="panel panel-color panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4 class="panel-title" style="font-size: 16px;">
                                     Discussions
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {!!Forum::gadget('user.forum.gadget')!!}
                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <a class="btn btn-sm btn-danger waves-effect waves-light text-uppercase" href="{!! trans_url('user/forum/forum') !!}">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="dashboard-content">
            <div class="panel panel-color panel-pink">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4 class="panel-title" style="font-size: 16px;">
                                News
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {!!News::gadget('user.news.gadget')!!}
                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <a class="btn btn-sm btn-danger waves-effect waves-light text-uppercase" href="{!! trans_url('user/news/news') !!}">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
