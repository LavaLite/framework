@forelse($workflow as $key => $val)
<div class="workflow-gadget-box">
    <p>{!!@$val->name!!}</p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->user->name!!} at {!! format_date($val->created_at)!!}</small></p>
</div>
@empty
<div class="workflow-gadget-box">
    <p>No Workflow</p>
</div>
@endif