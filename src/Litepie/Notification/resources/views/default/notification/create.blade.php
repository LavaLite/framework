
<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <a href="#" class="mobile-back-btn"><i class="las la-arrow-left"></i></a>
        <i class="las la-list app-sec-title-icon"></i>
        <h2>{!!__('Create')!!} {!! trans('notification::notification.name') !!}</h2>
        <div class="actions">
            <div class="action-buttons">
            <button type="button" class="btn btn-with-icon btn-link app-create btn-outline" 
                    data-action='STORE'
                    data-form="#form-create" 
                    data-load-to="#app-entry" 
                    data-list="#item-list">
                    <i class="las la-save"></i>{!!__('Create')!!}
                </button>
            </div>
            
            <div class="app-pagination-moble">
                <a href="#" class="prev"><i class="las la-arrow-up"></i></a>
                <a href="#" class="next"><i class="las la-arrow-down"></i></a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-8 entry-form">
            {!!Form::vertical_open()
            ->id('form-create')
            ->method('POST')
            ->files('true')
            ->action(guard_url('notification/notification'))!!}
            @php
            $data = form_merge_form($form['fields'], compact('data', 'meta'), true);
            $form = $data['form'];
            $mode = 'create';
            @endphp

            @include('notification::notification.partials.form')

            {!! Form::close() !!}
        </div>

            @include('notification::notification.partials.aside')
        </div>
    </div>

</div>

