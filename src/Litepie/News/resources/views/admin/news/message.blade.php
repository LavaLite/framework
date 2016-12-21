<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        @if($status == 'error')
            <div class="alert alert-danger">
                <h4>
                    <i class="icon fa fa-ban">
                    </i>
                    {{$step}}!
                </h4>
                {!!$message!!}
            </div>
         @else
            <div class="alert alert-success">
                <h4>
                    <i class="icon fa fa-check">
                    </i>
                    {{$step}}!
                </h4>
                {!!$message!!}
            </div>
        @endif
        </div>
    </div>
</div>
