@include('public::notifications')
<div class="dashboard-content">
	<div class="panel panel-color panel-inverse">
	    <div class="heading">
	        <h3 class="panel-title">
	            Auth clients 
	        </h3>
	        <p class="panel-sub-title m-t-5 text-muted">
	            Auth clients  for {{ users('name') }}
	        </p>
	    </div>
	    <div class="body">
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
	    </div>
	</div>
</div>
