<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <a href="#" class="mobile-back-btn"><i class="las la-arrow-left"></i></a>
        <i class="las la-list app-sec-title-icon"></i>
        <h2>{!!__('Edit')!!} {!!$data['title']!!}</h2>
        <div class="actions">
            <div class="action-buttons">
                <button type="button" class="btn btn-with-icon btn-link  btn-outline" 
                    data-action='UPDATE'
                    data-form="#form-edit" 
                    data-load-to="#app-entry" 
                    data-list="#item-list">
                    <i class="las la-save"></i>{!!__('Save')!!}
                </button>
                <button type="button" class="btn btn-with-icon btn-link  btn-outline"
                    data-action='SHOW'
                    data-load-to="#app-entry" 
                    data-url="{!!guard_url('notification/notification')!!}/{!!$data['id']!!}">
                    <i class="las la-window-close"></i>{!!__('Cancel')!!}
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
            ->method('PUT')
            ->id('form-edit')
            ->enctype('multipart/form-data')
            ->action(guard_url('notification/notification/'. $data['id']))!!}

            @php
            $data = form_merge_form($form['fields'], compact('data', 'meta'), true);
            $form = $data['form'];
            $mode = 'edit';
            @endphp

            @include('notification::notification.partials.form')
            {!!Form::close()!!}
        </div>

        @include('notification::notification.partials.aside')
        </div>
    </div>
</div>