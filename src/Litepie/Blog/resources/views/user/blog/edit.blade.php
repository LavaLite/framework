@include('public::notifications')

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="dashboard-content">
                    <div class="panel panel-color panel-inverse">
                            <div class="panel-heading">
                                    <h3 class="panel-title">{!!Trans('blog::blog.user_names')!!}</h3>
                                    <p class="panel-sub-title m-t-5 text-muted">{!!Trans('blog::blog.edit')!!} [ {{$blog->title}} ] </p>
                            </div>
                            <div class="panel-body">
                                {!!Form::vertical_open()
                                ->id('edit-blog-blog')
                                ->method('PUT')
                                ->files('true')
                                ->class('dashboard-form')
                                ->action(trans_url('user/blog/blog') .'/'.$blog->getRouteKey())!!}
                                    @include('blog::user.blog.partial.entry')

                                <div class="row m-t-20">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-danger waves-effect w-md waves-light text-uppercase">Update Blog</button>
                                         <a href="{!!trans_url('/user/blog/blog')!!}" class="btn btn-sm btn-inverse waves-effect waves-float m-l-5 text-uppercase"> Cancel</a>
                                    </div>
                                </div>

    {!! Form::close() !!}
                        </div>

                    </div>
            </div>
        </div>

