
           
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <h1 class="inner-title">
                            <span>{!! $blog['title'] !!}</span>
                        </h1>
                        <div class="blog-detail-main-slider">
                            {!!$blog->fileShow('images')->size('md')!!}
                        </div>
                         <?php
                            $timestamp = strtotime($blog['published_on']);
                            $day = date('D', $timestamp);
                        ?>
                        <div class="blog-detail-desc">
                            <p class="detail-tags m-b-20">{{$blog->blog_categories['name']}} {{$day}} , 
                            {!! $blog['posted_on'] !!}</p>
                            
                            <div class="quotes">
                                <p>{!! $blog['description'] !!}</p>
                                
                            </div>
                            
                        </div>
                        <div class="blog-tags-wraper m-t-30">
                            <p><i class="icon icon-tag"></i> Travel , Beach , Family</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="blog-detail-side-search-wraper">
                         {!!Form::open()->method('GET')
                         ->action(trans_url('user/blog/blog'))!!}
                            {!!Form::text('search')->type('text')->class('form-control')->placeholder('Search for...')->raw()!!}
                            <i class="icon-magnifier"></i>
                             {!! Form::close()!!}
                            
                        </div>
                        {!!Blog::getCategories()!!}

                        {!!Blog::latest()!!}
                    </div>
