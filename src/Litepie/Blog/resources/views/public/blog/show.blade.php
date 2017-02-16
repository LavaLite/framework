<section class="blog-detail-wraper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <h1 class="inner-title">
                    <span>{{$blog['title']}}</span>
                </h1>
                <div class="blog-detail-main-slider">
                @forelse($blog->getImages('blog.lg', 'images') as $image)
                    <img src="{!!url(@$image)!!}" class="img-responsive" alt="">
                @empty
                @endif
                </div>
                @if(!empty ($blog['posted_on']))
                        <?php
                            $timestamp = strtotime($blog['posted_on']);
                            $day = date('D', $timestamp);
                        ?>
                        @endif
                <div class="blog-detail-desc">
                    <p class="detail-tags m-b-20"><i class="ion ion-android-person"></i>{{$blog['user']['name']}} on <a>{{$blog['blogCategories']['name']}} </a> , at {{@$day}} ,{{format_date($blog['posted_on'])}}</p>

                    <p class="blog-detail-para">{{$blog['description']}}</p>
                </div>

            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="blog-detail-side-search-wraper">
                 {!!Form::open()->method('GET')
                 ->action(trans_url('blogs'))!!}
                    {!!Form::text('search')->type('text')->class('form-control')->placeholder('Search Blogs')->raw()!!}
                    <i class="icon-magnifier"></i>
                     {!! Form::close()!!}

                </div>

                {!!Blog::getCategories()!!}

                {!!Blog::latest()!!}

            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
            $(".blog-detail-main-slider").owlCarousel({
                margin: 0,
                dots: false,
                nav: true,
                autoplay:true,
                navText: ['<i class="ion ion-ios-arrow-left"></i>','<i class="ion ion-ios-arrow-right"></i>'],
                responsive:{
                    0:{
                        items:1
                    }
                }
            });
    });
</script>

