
       <div class='col-md-4 col-sm-6'>
              {!! Form::text('name')
              -> label(trans('contact::contact.label.name'))
              -> placeholder(trans('contact::contact.placeholder.name'))       
              -> required()!!}
       </div>

       <div class='col-md-4 col-sm-6'>
              {!! Form::email('email')
              -> label(trans('contact::contact.label.email'))
              -> placeholder(trans('contact::contact.placeholder.email'))
              -> required()!!}
       </div>

       <div class='col-md-4 col-sm-6'>
              {!! Form::number('phone')
              -> label(trans('contact::contact.label.phone'))
              -> placeholder(trans('contact::contact.placeholder.phone'))
              -> required()!!}
       </div>

       <div class='col-md-8 col-sm-8'>
              {!! Form::textarea('address')
              -> label(trans('contact::contact.label.address'))
              -> placeholder(trans('contact::contact.placeholder.address'))
              -> rows(5)!!}
       </div>

       <div class='col-md-4 col-sm-6'>
              {!! Form::number('mobile')
              -> label(trans('contact::contact.label.mobile'))
              -> placeholder(trans('contact::contact.placeholder.mobile'))
              ->required()!!}
       </div>

       <div class='col-md-4 col-sm-6'>
              {!! Form::url('website')
              -> label(trans('contact::contact.label.website'))
              -> placeholder(trans('contact::contact.placeholder.website'))!!}
       </div>
