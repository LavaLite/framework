<div class="container">
    <h1> Categories</h1>

    <div class="row">
        <div class="col-md-8">
            @forelse($blog_categories as $blog_category)
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $blog_category['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('blog') }}/{!! $blog_category->getPublicKey() !!}" class="btn btn-default pull-right"> {{ trans('app.details')  }}</a>
                    </div>
                </div>
                <hr/>

                <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="name">
                    {!! trans('blog::blog_category.label.name') !!}
                </label><br />
                    {!! $blog_category['name'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="status">
                    {!! trans('blog::blog_category.label.status') !!}
                </label><br />
                    {!! $blog_category['status'] !!}
            </div>
        </div>
    </div>
            </div>
            @empty
            <div class="card-box">
                <h4 class="text-dark  header-title m-t-0">No modules</h4>
                <p class="text-muted m-b-25 font-13">
                    Your search for <b>'{{Request::get('search')}}'</b> returned empty result.
                </p>
            </div>
            @endif
            {{$blogs->render()}}
        </div>
        <div class="col-md-4">
            @include('blog::public.blog_category.aside')
        </div>
    </div>
</div>