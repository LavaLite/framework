<section class="news-wraper">        
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <h1 class="main-title">
                    <small>
                        Latest News
                    </small>
                    Our
                    <span>
                        News
                    </span>
                </h1>
                <p>
                    New information or a report about something that has happened recently.Information that is reported in a newspaper, magazine, television news program, etc. Someone or something that is exciting and in our news
                </p>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-xs text-right">

                <img alt="" src="{!!url('img/news-side-icon.png')!!}">
                </img>
            </div>
        </div>
        <div class="row m-t-40">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                @forelse($news as $key=>$value)
                <?php
                    $timestamp = strtotime($value['published_on']);
                    $day = date('D', $timestamp);
                ?>
                <div class="news-list-item">

                        <a  href="{{trans_url('news')}}/{{@$value['slug']}}">
                        <img class="img-responsive" alt="" src="{!!url(@$value->defaultImage('news.xl','images'))!!}"></a>



                        <div class="blog-list-inner-desc">
                            <h1 class="inner-title">
                                <span>
                                   <a  href="{{trans_url('news')}}/{{@$value['slug']}}"> {{@$value['title']}} </a>
                                </span>
                            </h1>
                            <div class="blog-detail-desc">
                                <p class="detail-tags m-b-20">
                                    <i class="ion ion-android-person">
                                    </i>
                                    {{@$value->user['name']}} on {{$day}} , {{format_date($value->created_at)}}
                                </p>
                                <p class="blog-detail-para">
                                    {!!substr($value['description'],0,300)!!}...
                                </p>
                                <p>
                                    <a class="btn btn-danger waves-effect w-md waves-light" href="{{trans_url('news')}}/{{@$value['slug']}}">
                                        Read More
                                    </a>
                                </p>
                            </div>
                        </div>
                    </img>
                </div>
                @empty
                  <div class="news-list-item">
                       <div class="blog-list-inner-desc">
                            <h1 class="inner-title">
                                <span>
                                No News found!
                                </span>
                            </h1>
                        </div>

                  </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="blog-detail-side-search-wraper">
                    {!!Form::open()->method('GET')!!}
                    {!!Form::text('search')->type('text')->class('form-control')->placeholder('Search News')->raw()!!}
                    <i class="icon-magnifier">
                    </i>
                    {!! Form::close()!!}
                </div>
                {!!News::latest()!!}
            </div>
        </div>
    </div>
</section>