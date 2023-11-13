<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2>  {!! trans('app.manage') !!} {!! trans('setting::setting.names') !!}</h2>
        <div class="actions">
            <button group="button" class="btn btn-with-icon btn-link  btn-outline"
                data-action='UPDATE'
                data-form="#form-edit"
                data-load-to="#app-entry" >
                <i class="las la-save"></i>{{__('Save')}}
            </button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline"
                data-action='SHOW'
                data-load-to="#app-entry"
                data-url="{{guard_url('setting/0')}}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-edit')
    ->method('POST')
    ->files('true')
    ->action(guard_url('setting/setting/'.$group))!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="app-entry-form-section" id="basic">
                    <div class="section-title">{{trans('setting::setting.title.'. $group)}} {!! trans('setting::setting.name') !!}</div>
                    <hr/>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            @if(is_array($form['fields']))
                                @foreach($form['fields'] as $group => $fields)
                                <br/>
                                <fieldset>
                                    <legend>{{dd($form)}}</legend>
                                    <div class="row clearfix">
                                    @foreach($fields as $key => $field)
                                    <div class="col-{!!$field['col'] ?? '12'!!}">
                                        {!!
                                        Form::input($field['key'])
                                        ->apply($field)
                                        ->mode('edit')
                                        !!}
                                    </div>
                                    @endforeach
                                    </div>
                                </fieldset>
                                @endforeach
                            @else
                                <span class="text-center">Settings not found!</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<style>
legend {
    margin-bottom:.1rem;
}
</style>
