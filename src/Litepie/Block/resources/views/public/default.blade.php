<div class="features-header">
                <h2>{!!$category->title!!}</h2>
                <p> {!!$category->details!!} </p>
            </div>
@foreach ($blocks as $block)
<div class="col-md-4">
    <div class="feature">
        <i class="{!!$block->icon!!}"></i>
        <h6>{!!$block->name!!}</h6>
        <p>{!!$block->description!!} ​ </p>
    </div>
</div>
@endforeach