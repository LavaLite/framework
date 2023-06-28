<div class="col-lg-4 d-none d-lg-block">
    <aside class="app-create-steps">
        <h5 class="steps-header">{!!__('Steps')!!}</h5>
        <div class="steps-wrap" id="steps_nav">
            @foreach($form['fields'] as $key => $value)
            <a class="step-item active" href="#{!!$key!!}"><span>{!!$loop->index+1!!}</span> {!!$form['groups'][$key]['name']['name']!!} </a>
            @endforeach
        </div>
    </aside>
    <br />
    @if($mode == 'show')
        @endif
</div>