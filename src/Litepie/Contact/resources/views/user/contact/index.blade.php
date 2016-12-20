@include('public::notifications')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> My Contacts </h4>
        </div>
        <div class="col-md-6">
            <a href="{{ trans_url('/user/contact/contact/create') }}" class="btn btn-default pull-right"> {{ trans('app.create')  }} Contact</a>
        </div>
    </div>
    <p class="text-muted m-b-25 font-13">
        Your awesome text goes here.
    </p>
    <hr>
    <div class="row">
        <div class="col-md-4 m-b-5 pull-right">
            {!!Form::open()->method('GET')!!}
            <div class="input-group">
              {!!Form::text('search')->type('search')->class('form-control')->placeholder('Search for...')->raw()!!}
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
              </span>
            </div>
            {!! Form::close()!!}
        </div>
    </div>   
    
    <div class="table-responsive">
        <table class="table">
            <thead class="list_head">
                <tr>
                    <th>{!! trans('contact::contact.label.name')!!}</th>
        <th>{!! trans('contact::contact.label.phone')!!}</th>
        <th>{!! trans('contact::contact.label.mobile')!!}</th>
        <th>{!! trans('contact::contact.label.email')!!}</th>
        <th>{!! trans('contact::contact.label.website')!!}</th>
        <th>{!! trans('contact::contact.label.address')!!}</th>
                    <th width="150">{!! trans('contact::contact.label.status')!!}</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->mobile }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->website }}</td>
                    <td>{{ $contact->address }}</td>
                    <td><span class="label status-{{ $contact->status }}"> {{ $contact->status }} </span></td>
                    <td>
                        <a href="{{ trans_url('/user') }}/contact/contact/{!! $contact->getRouteKey() !!}"> View </a>
                        <a href="{{ trans_url('/user') }}/contact/contact/{!! $contact->getRouteKey() !!}/edit"> Edit </a>
                        <a data-action="DELETE" 
                            data-href="{{ trans_url('/user') }}/contact/contact/{!! $contact->getRouteKey() !!}" 
                            href="trans_url('/user')/contact/contact/{!! $contact->getRouteKey() !!}"> 
                            Delete 
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $contacts->links() }}
</div>