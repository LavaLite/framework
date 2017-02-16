<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-8 title-main">
                                <i class="pe-7s-display2"></i>
                                <h4 class="title">{!! trans('contact::contact.title.user') !!}</h4>
                                <p class="sub-title">{!! trans('contact::contact.title.sub.user') !!}</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-form">
                                    {!!Form::open()
                                   ->method('GET')
                                   ->class('form pn')
                                   ->action(trans_url(get_guard('url').'/contact/contact'))!!}
                                    <div class="form-group form-white mn">
                                      {!!Form::text('search')->type('text')->placeholder('Search')->raw()!!}
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-round btn-white btn-raised search-btn"><i class="fa fa-search"></i></button>
                                    {!! Form::close()!!}
                                    <a href="{!!trans_url(get_guard('url').'/contact/contact/create')!!}" rel="tooltip" class="btn btn-white btn-round btn-simple btn-icon pull-right add-new" data-original-title="" title="">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        @include('public::notifications')
                        <table class="table table-bigboy">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th>{!! trans('contact::contact.label.name')!!}</th>
                    <th>{!! trans('contact::contact.label.phone')!!}</th>
                    <th>{!! trans('contact::contact.label.mobile')!!}</th>
                    <th>{!! trans('contact::contact.label.email')!!}</th>
                    <th>{!! trans('contact::contact.label.default')!!}</th>
                    <th>{!! trans('contact::contact.label.website')!!}</th>
                    <th>{!! trans('contact::contact.label.details')!!}</th>
                    <th>{!! trans('contact::contact.label.address_line1')!!}</th>
                    <th>{!! trans('contact::contact.label.address_line2')!!}</th>
                    <th>{!! trans('contact::contact.label.street')!!}</th>
                    <th>{!! trans('contact::contact.label.city')!!}</th>
                    <th>{!! trans('contact::contact.label.country')!!}</th>
                    <th>{!! trans('contact::contact.label.pin_code')!!}</th>
                    <th>{!! trans('contact::contact.label.lat')!!}</th>
                    <th>{!! trans('contact::contact.label.lng')!!}</th>
                    <th>{!! trans('contact::contact.label.status')!!}</th>
                    <th>{!! trans('contact::contact.label.status')!!}</th>
                    <th>{!! trans('contact::contact.label.created_at')!!}</th>
                    <th>{!! trans('contact::contact.label.updated_at')!!}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <a href="{{trans_url('contact')}}/{{$contact->getPublickey()}}">
                                              <img alt="" class="img-responsive" src="{!!url($contact->defaultImage('sm','images'))!!}">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->mobile }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->default }}</td>
                    <td>{{ $contact->website }}</td>
                    <td>{{ $contact->details }}</td>
                    <td>{{ $contact->address_line1 }}</td>
                    <td>{{ $contact->address_line2 }}</td>
                    <td>{{ $contact->street }}</td>
                    <td>{{ $contact->city }}</td>
                    <td>{{ $contact->country }}</td>
                    <td>{{ $contact->pin_code }}</td>
                    <td>{{ $contact->lat }}</td>
                    <td>{{ $contact->lng }}</td>
                    <td>{{ $contact->status }}</td>
                                    <td class="td-actions">
                                        <a href="{{trans_url('contact')}}/{!!$contact->getRouteKey()!!}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Contact" class="btn btn-info btn-simple">
                                            <i class="material-icons">panorama</i>
                                        </a>
                                        <a href="{!! trans_url(get_guard('url').'/contact/contact') !!}/{!! $contact->getRouteKey() !!}/edit" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit Contact" class="btn btn-success btn-simple">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Remove Contact" class="btn btn-danger btn-simple" data-action="DELETE" data-href="{!! trans_url(get_guard('url').'/contact/contact') !!}/{!! $contact->getRouteKey() !!}" data-remove="{!! $contact->getRouteKey() !!}">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td><h4>No contacts found.</h4></td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        {{$contacts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>