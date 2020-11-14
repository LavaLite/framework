@forelse($client as $key => $val)
<div class="client-gadget-box">
    <p>{!!@$val->name!!}</p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->user->name!!} at {!! format_date($val->created_at)!!}</small></p>
</div>
@empty
<div class="client-gadget-box">
    <p>No Client</p>
</div>
@endif