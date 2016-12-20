@forelse($news as $key => $val)
<div class="news-gadget-box">
    <p>{!!@$val->title!!}</p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->user->name!!} at {!! format_date($val->created_at)!!}</small></p>
</div>
@empty
<div class="news-gadget-box">
    <p>No News</p>
</div>
@endif