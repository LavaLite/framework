<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">  {!! trans('contact::contact.name') !!}</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#contact-contact-entry' data-href='{{trans_url('admin/contact/contact/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($contact->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#contact-contact-entry' data-href='{{ trans_url('/admin/contact/contact') }}/{{$contact->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#contact-contact-entry' data-datatable='#contact-contact-list' data-href='{{ trans_url('/admin/contact/contact') }}/{{$contact->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif

        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('contact-contact-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/contact/contact'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">                     
               <div class="tab-pan-title">  {!! trans('app.view') !!}  {!! trans('contact::contact.name') !!} [ {!!$contact->name!!} ] </div>
               <div class="row disabled">
                    @include('contact::admin.contact.partial.entry')
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>