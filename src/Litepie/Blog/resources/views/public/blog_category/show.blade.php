<section class="blog-list-wraper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <h1 class="main-title">
                    <small>
                        Latest Blogs
                    </small>
                    Our
                    <span>
                        Blogs
                    </span>
                </h1>
                <p>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-xs text-right">
             <img alt="" src="{!!trans_url('img/news-side-icon.png')!!}">
                </img>
            </div>
        </div>
        <div class="row m-t-40">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                @forelse($blog_category->blog as $key=>$value)
                <?php
                    $timestamp = strtotime($value['published_on']);
                    $day = date('D', $timestamp);
                ?>
                <div class="news-list-item">
                        <!-- @if(!empty(@$value['images']))
                        <a  href="{{trans_url('blogs')}}/{{@$value['slug']}}"> <img class="img-responsive" alt="" src="{!!trans_url('/image/sl/'.$value->default_image)!!}"></a>

                        @else
                      <a  href="{{trans_url('blogs')}}/{{@$value['slug']}}">  <img alt="" class="img-responsive" src="img/blog1.jpg" ></a>
                        @endif -->
                         <a  href="{{trans_url('blogs')}}/{{@$value['slug']}}"> <img class="img-responsive" alt="" src="{!!url($value->defaultImage('blog.lg','images'))!!}"></a>
                        <div class="blog-list-inner-desc">
                            <h1 class="inner-title">
                                <span>
                                    {{@$value['title']}}
                                </span>
                            </h1>
                            <div class="blog-detail-desc">
                                <p class="detail-tags m-b-20">
                                    <i class="ion ion-android-person">
                                    </i>
                                    {{@$value['user']['name']}} on {{$day}} , {{$value['posted_on']}}
                                </p>
                                <p class="blog-detail-para">
                                    {!!substr($value['description'],0,300)!!}...
                                </p>
                                <p>
                                    <a class="btn btn-danger waves-effect w-md waves-light" href="{{trans_url('blogs')}}/{{@$value['slug']}}">
                                        Read More
                                    </a>
                                </p>
                            </div>
                        </div>
                    </img>
                </div>
                @empty
                @endif
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="blog-detail-side-search-wraper">
                    {!!Form::open()
                     ->action(trans_url('blogs'))
                    ->method('GET')!!}

                    {!!Form::text('search')->type('text')->class('form-control')->placeholder('Search for blogs')->raw()!!}
                    <i class="icon-magnifier">
                    </i>
                    {!! Form::close()!!}
                </div>
                {!!Blog::getCategories()!!}
                {!!Blog::latest()!!}
            </div>
        </div>
    </div>
</section>