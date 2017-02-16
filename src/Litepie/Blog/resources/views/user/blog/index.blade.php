<div class="dashboard-content">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h3 class="panel-title">
                        {!! trans('blog::blog.user_names') !!}
                    </h3>
                    <p class="panel-sub-title m-t-5 text-muted">
                       {!! trans('blog::blog.user_name') !!}
                    </p>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="row m-t-5">
                        <div class="col-xs-12 col-sm-7 m-b-5">
                                {!!Form::open()
                                ->method('GET')
                                ->action(trans_url('user/blog/blog'))!!}
                                <div class="input-group">
                                    {!!Form::text('search')->type('text')->class('form-control')->placeholder('Search for Blogs')->raw()!!}
                                    <span class="input-group-btn">
                                        <button type='submit' class="btn btn-danger" type="button">
                                            <i class="icon-magnifier">
                                            </i>
                                        </button>
                                    </span>
                                </div>
                                {!! Form::close()!!}
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <a class=" btn btn-success btn-block text-uppercase f-12" href="{{ trans_url('/user/blog/blog/create') }}">
                                {{ trans('cms.create')  }} Blog
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body" >
            @foreach($blogs as $blog)
            <div class="popular-post-block" id="{!! $blog->getRouteKey() !!}">
                <div class="row">
                    <div class="dashboard-blog-pic">
                        <a href="{{trans_url('blogs')}}/{{@$blog['slug']}}">
                        <img alt="" class="img-responsive" src="{!!url($blog->defaultImage('blog.sm','images'))!!}"></a>
                    </div>
                    <?php
                        $timestamp = strtotime($blog['published_on']);
                        $day = date('D', $timestamp);
                    ?>
                    <div class="dashboard-blog-desc popular-post-inner">
                        <div class="popular-post-desc">
                            <a href="{{trans_url('blogs')}}/{{@$blog['slug']}}">
                                <h4>
                                    {{$blog['title']}}
                                </h4>
                            </a>
                            <p>
                                {{$day}} , {{format_date($blog['posted_on'])}}
                            </p>
                        </div>
                    </div>
                    <div class="dashboard-blog-actions text-right">
                        <a class="btn btn-icon waves-effect btn-success m-b-5" href="{{trans_url('blogs')}}/{{@$blog['slug']}}">
                            <i class="fa fa-eye">
                            </i>
                        </a>
                        <a class="btn btn-icon waves-effect btn-primary m-b-5" href="{{ trans_url('/user') }}/blog/blog/{!! $blog->getRouteKey() !!}/edit">
                            <i class="fa fa-pencil">
                            </i>
                        </a>
                        <!-- <a data-action="DELETE"  data-href="{{ trans_url('/user') }}/blog/blog/{!! $blog->getRouteKey() !!}"  class="btn btn-icon waves-effect btn-danger"data-remove="{!! $blog->getRouteKey() !!}"><i class="fa fa-trash"></i></a> -->
                        <a class="btn btn-icon waves-effect btn-danger" data-action="DELETE" data-href="{{ trans_url('/user/blog/blog') }}/{!! $blog->getRouteKey() !!}" data-remove="{!! $blog->getRouteKey() !!}">
                            <i class="fa fa-trash">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>