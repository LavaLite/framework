<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="app-entry-form-section" id="basic">
                <div class="section-title">Details</div>
                <div class='row'>
                    <div class='col-md-4 col-sm-6'>
                        {!! Form::text('name')
                        -> required()
                        -> label(trans('user::client.label.name'))
                        -> placeholder(trans('user::client.placeholder.name'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::email('email')
                        -> required()
                        -> label(trans('user::client.label.email'))
                        -> placeholder(trans('user::client.placeholder.email'))!!}
                    </div>
                    @if($mode=='create')
                    <div class='col-md-4 col-sm-6'>
                        {!! Form::password('password')
                        -> required()
                        -> label(trans('user::client.label.password'))
                        -> placeholder(trans('user::client.placeholder.password'))!!}
                    </div>
                    @else
                    <div class='col-md-4 col-sm-6'>
                        {!! Form::password('password')
                        -> required()
                        -> disabled(true)
                        -> label(trans('user::client.label.password').' <a href="javascript:void(0)" class="pwdedit"><i
                                class="fa fa-edit" aria-hidden="true"></i></a>')
                        -> placeholder(trans('user::client.placeholder.password'))!!}
                    </div>
                    @endif
                    <div class='col-md-4 col-sm-6'>
                        {!! Form::inline_radios('sex')
                        -> radios(trans('user::client.options.sex'))
                        -> label(trans('user::client.label.sex'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        <div class="form-group">
                            <label>DOB</label>
                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                {!! Form::text('dob')
                                -> placeholder(trans('user::client.placeholder.dob'))
                                ->raw()!!}
                                <div class="input-group-append" data-target="#datetimepicker4"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4 col-sm-6'>
                        {!! Form::tel('mobile')
                        -> required()
                        -> label(trans('user::client.label.mobile'))
                        -> placeholder(trans('user::client.placeholder.mobile'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::tel('phone')
                        -> required()
                        -> label(trans('user::client.label.phone'))
                        -> placeholder(trans('user::client.placeholder.phone'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::textarea ('address')
                        -> label(trans('user::client.label.address'))
                        -> placeholder(trans('user::client.placeholder.address'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::text('street')
                        -> label(trans('user::client.label.street'))
                        -> placeholder(trans('user::client.placeholder.street'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::text('city')
                        -> label(trans('user::client.label.city'))
                        -> placeholder(trans('user::client.placeholder.city'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::text('district')
                        -> label(trans('user::client.label.district'))
                        -> placeholder(trans('user::client.placeholder.district'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::text('state')
                        -> label(trans('user::client.label.state'))
                        -> placeholder(trans('user::client.placeholder.state'))!!}
                    </div>

                    <div class='col-md-4 col-sm-6'>
                        {!! Form::text('country')
                        -> label(trans('user::client.label.country'))
                        -> placeholder(trans('user::client.placeholder.country'))!!}
                    </div>



                    <div class='col-md-4 col-sm-6'>
                        {!! Form::url('web')
                        -> label(trans('user::client.label.web'))
                        -> placeholder(trans('user::client.placeholder.web'))!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(".pwdedit").click(function() {
    console.log('dsfdsf');
    $("#password").removeAttr('disabled');
});
$(function() {
    $('#datetimepicker4').datetimepicker({
        format: 'YYYY-DD-MM'
    });
});
</script>