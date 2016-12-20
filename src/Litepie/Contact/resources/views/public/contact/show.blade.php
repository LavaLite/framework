<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $contact['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('contacts') }}" class="btn btn-default pull-right"> Back</a>
                    </div>
                </div>
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
                    {!! nl2br($contact['address']) !!}
            </div>
        </div>
    </div>
            </div>  
        </div>  
        <div class="col-md-4">
            @include('contact::public.contact.aside')
        </div>

    </div>
</div>