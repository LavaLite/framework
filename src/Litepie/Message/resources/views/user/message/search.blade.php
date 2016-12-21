<?php
function humanTiming ($time)
{
$time = time() - $time; // to get the time since that moment
$time = ($time
<1)? 1 : $time;
    $tokens = array (
    31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second' );
    foreach ($tokens as $unit => $text) {
    if ($time < $unit) continue;
    $numberOfUnits = floor($time / $unit);
    return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
    }
?>
@forelse($messages['data'] as $key => $value)
<tr id="{!!$value->id!!}" class="check-read" data-status="{!!@$value->read!!}" style="background-color: {!!($value->read ==1)? '#f9f9f9' : '#fff';!!}">

    <td class="mail-select">
        <div class="checkbox checkbox-danger">
             <input class="checkbox1" name="listMessageID" type="checkbox" value="{!!$value->getRouteKey()!!}" id="message_check_{!!$value->id!!}">
             <label for="message_check_{!!$value->id!!}"></label>
        </div>
    </td>

    <td class="mailbox-star">
        <a class="btn-important">
            <i class="fa fa-star">
            </i>
        </a>
    </td>
   
    <td class="mailbox-name single">
        <a href="#">
            {!!@$value->user->email!!}
        </a>
    </td>
    <td class="mailbox-subject single">
        <b>
            {!!@$value->subject!!}
        </b>
    </td>
    <td class="mailbox-attachment single">
    </td>
    <td class="mailbox-date single">
    {!! humanTiming(strtotime(@$value['created_at'])) !!} ago
    </td>

</tr>
@empty
<tr><td colspan="4">No messages</td></tr>
@endif
