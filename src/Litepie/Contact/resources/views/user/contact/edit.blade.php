@include('public::notifications')
<div class="container"> 
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> {{ trans('app.edit')  }} Module </h4>
        </div>
        <div class="col-md-6">
            <a href="{{ trans_url('/user/contact/contact') }}" class="btn btn-default pull-right"> {{ trans('app.back')  }}</a>
        </div>
    </div>
    <p class="text-muted m-b-25 font-13">
        Your awesome text goes here.
    </p>
    <hr/>


    {!!Form::horizontal_open()
    ->id('edit-contact-contact')
    ->method('PUT')
    ->files('true')
    ->action(trans_url('user/contact/contact') .'/'.$contact['eid'])!!}
        @include('contact::user.contact.partial.entry')
    {!! Form::close() !!}
</div>
