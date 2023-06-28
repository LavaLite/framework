<div class="col-lg-4 d-none d-lg-block">
    <aside class="app-create-steps">
        <h5 class="steps-header">{!!__('Steps')!!}</h5>
        <div class="steps-wrap" id="steps_nav">
            @foreach($form['groups'] as $key => $value)
            <a class="step-item active" href="#{!!$key!!}"><span>{!!$loop->index+1!!}</span> {!!$value['name']!!} </a>
            @endforeach
        </div>
    </aside>
    <br />
    @if($mode == 'show')
        @endif
</div>