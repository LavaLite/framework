
@if (Session::has('message'))
    @if (Session::get('code') < 200)
        <div class="alert alert-info">
            <button type="button" aria-hidden="true" class="close">
                <i class="material-icons">close</i>
            </button>
            <span>
                <b> Info - </b> {{ Session::get('message') }}</span>
        </div>
    @elseif  (Session::get('code') < 300)
        <div class="alert alert-success">
            <button type="button" aria-hidden="true" class="close">
                <i class="material-icons">close</i>
            </button>
            <span>
                <b> Success - </b> {{ Session::get('message') }}</span>
        </div>
    @elseif  (Session::get('code') < 400)
        <div class="alert alert-warning">
            <button type="button" aria-hidden="true" class="close">
                <i class="material-icons">close</i>
            </button>
            <span>
                <b> Warning - </b> {{ Session::get('message') }}</span>
        </div>
    @else
        <div class="alert alert-danger">
            <button type="button" aria-hidden="true" class="close">
                <i class="material-icons">close</i>
            </button>
            <span>
                <b> Error - </b> {{ Session::get('message') }}</span>
        </div>
    @endif
@endif

@if (Session::has('errors'))
        <div class="alert alert-danger">
            <button type="button" aria-hidden="true" class="close">
                <i class="material-icons">close</i>
            </button>
            <ul>
              @foreach(Session::get('errors')->all() as $message)
              <li>{{$message}} </li>
              @endforeach
            </ul>
        </div>
@endif
