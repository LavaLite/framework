<section class="blog-detail-wraper">
<div class="container" style="min-height:500px;margin-top:20px;">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="inner-title">
                <span>
                    {{@$news['title']}}
                </span>
            </h1>
            <div class="blog-detail-main-slider">
                <img  src="{!!url($news->defaultImage('xl', 'images'))!!}" alt="" class=" img-responsive"/>
            </div>
            <div class="blog-detail-desc">
                <p class="detail-tags m-b-20">
                    <i class="ion ion-android-person">
                    </i>
                    {{@$news->user->name}}  , {{format_date($news->created_at)}}
                </p>
                <p class="blog-detail-para">
                    {!!$news['description']!!}
                </p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="blog-detail-side-search-wraper">
                {!!Form::open()->method('GET')
                     ->action(URL::to('news'))!!}
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




