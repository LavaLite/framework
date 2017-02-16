<div class="blog-detail-side-category-wraper clearfix">
    <h3>Categories</h3>
    <ul>
        <li class="{{ (Request::is('blogs'))? 'active' : ''}}"><a href="{{trans_url('blogs')}}">All</a><span class="cat-number">{{Blog::count('blog')}}</span></li>
        @forelse($blogs as  $value)
        <li class="{{(Request::is('*category/blog/'.$value->slug))? 'active' : ''}}"><a href="{{trans_url('category/blog')}}/{{@$value->slug}}">{{$value->name}}</a><span class="cat-number">{{Blog::countBlogsCategory($value->id)}}</span></li>
        @empty
        @endif

    </ul>
</div>
