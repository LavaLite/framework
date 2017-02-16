@forelse($revision as $key => $val)
<div class="revision">
    <p>{!!@$val->name!!}</p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->user->name!!} at {!! format_date_time($val->created_at)!!}</small></p>
</div>
@empty
<div class="revision">
    <p>No Revision</p>
</div>
@endif