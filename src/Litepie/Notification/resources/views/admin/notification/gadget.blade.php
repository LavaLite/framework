@forelse($notifications as $key => $val)
<?php
    $class = ['complete' => 'label-info','verify' => 'label-warning','approve' => 'label-primary','publish' => 'label-success','unpublish' => 'label-danger','archive' => 'label-default'];
?>
<div class="news-gadget-box">
    <p>{!!@$val->data['name']!!}<span class="label {{@$class[@$val->data['action']]}} pull-right">{!!ucwords(@$val->data['action'])!!}</span></p>
    <p><span class="text-muted"><small><i class="ion ion-android-person"></i> {!!@$val->data['user']!!} at {!! format_date_time($val->created_at)!!}</small></span></p>
</div>
@empty
<div class="news-gadget-box">
    <p>No unread notifications</p>
</div>
@endif