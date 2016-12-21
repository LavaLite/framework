<div class="blog-detail-side-popular-posts-wraper">
    <h3>
        Recent News
    </h3>
    @foreach($news as $latests)
    <div class="popular-post-block">
        <div class="row">
            <div class="col-xs-4">

              <a  href="{{trans_url('news')}}/{{@$latests['slug']}}">
              <img alt="" class="img-responsive" src="{!!url(@$latests->defaultImage('news.sm','images'))!!}"></a>

            </div>
            <div class="col-xs-8 popular-post-inner">
                <div class="popular-post-desc">
                    <a href="{{trans_url('news')}}/{{@$latests['slug']}}">
                        <h4>
                            {{$latests->title}}
                        </h4>
                    </a>
                    <p>
                        {{format_date($latests->published_on)}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
