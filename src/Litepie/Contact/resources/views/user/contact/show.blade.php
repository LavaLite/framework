@include('public::notifications')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> Details of {!! $contact['name'] !!} </h4>
        </div>
        <div class="col-md-6">
            <div class='pull-right'>
                <a href="{{ trans_url('/user/contact/contact') }}" class="btn btn-default"> {{ trans('app.back')  }}</a>
                <a href="{{ trans_url('/user/contact/contact') }}/{{ contact->getRouteKey() }}/edit" class="btn btn-success"> {{ trans('app.edit')  }}</a>
                <a href="{{ trans_url('/user/contact/contact') }}/{{ contact->getRouteKey() }}/copy" class="btn btn-warning"> {{ trans('app.copy')  }}</a>
                <a href="{{ trans_url('/user/contact/contact') }}/{{ contact->getRouteKey() }}/delete" class="btn btn-danger"> {{ trans('app.delete')  }}</a>
            </div>
        </div>
    </div>
    <p class="text-muted m-b-25 font-13">
        Your awesome text goes here.
    </p>
    <hr/>

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="name">
                    {!! trans('contact::contact.label.name') !!}
                </label><br />
                    {!! $contact['name'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="phone">
                    {!! trans('contact::contact.label.phone') !!}
                </label><br />
                    {!! $contact['phone'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="mobile">
                    {!! trans('contact::contact.label.mobile') !!}
                </label><br />
                    {!! $contact['mobile'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="email">
                    {!! trans('contact::contact.label.email') !!}
                </label><br />
                    {!! $contact['email'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="website">
                    {!! trans('contact::contact.label.website') !!}
                </label><br />
                    {!! $contact['website'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="address">
                    {!! trans('contact::contact.label.address') !!}
                </label><br />
                    {!! $contact['address'] !!}
            </div>
        </div>
    </div>
</div>