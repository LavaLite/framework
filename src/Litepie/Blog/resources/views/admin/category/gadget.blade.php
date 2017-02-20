@forelse($blog_category as $key => $val)
<div class="blog_category-gadget-box">
    <p>{!!@$val->name!!}</p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->user->name!!} at {!! format_date($val->created_at)!!}</small></p>
</div>
@empty
<div class="blog_category-gadget-box">
    <p>No BlogCategory</p>
</div>
@endif