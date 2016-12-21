@forelse($news as $key => $value)
<div class="news-gadget-box">
    <p>{!!@$value->title!!}</p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$value->user->name!!} at {!!date('d M, Y',strtotime($value->created_at))!!}</small></p>
</div>
@empty
<div class="news-gadget-box">
    <p>No News</p>
</div>
@endif