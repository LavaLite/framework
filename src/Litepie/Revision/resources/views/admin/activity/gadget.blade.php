<?php 
    $class = ['Deleted' => 'danger', 'Created' => 'primary', 'Updated' => 'success'];
?>
@forelse($activity as $key => $val)
<div class="activity">
    <p>{!!@$val->name!!}<span class="pull-right label label-xs label-{{$class[@$val->action]}}">{!!@$val->action!!}</span></p>
    <p class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->user->name!!} at {!! format_date_time($val->created_at)!!}</small></p>
</div>
@empty
<div class="activity">
    <p>No Activity</p>
</div>
@endif