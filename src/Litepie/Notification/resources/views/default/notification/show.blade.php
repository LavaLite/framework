@if(isset($data['id']) && $data['id'] != '')
<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <a href="#" class="mobile-back-btn"><i class="las la-arrow-left"></i></a>
        <i class="las la-list app-sec-title-icon"></i>
        <h2>{!!__('Show')!!} {!!$data['title']!!}</h2>
        <div class="actions">
            <div class="action-buttons">
                <button type="button" class="btn btn-with-icon btn-link" data-action='EDIT' data-load-to="#app-entry"
                    data-url="{!!guard_url('notification/notification')!!}/{!!$data['id']!!}/edit"><i
                        class="las la-save"></i>Edit</button>
                <button type="button" class="btn btn-with-icon btn-link" data-action='DELETE' data-load-to="#app-entry"
                    data-list="#item-list" data-url="{!!guard_url('notification/notification')!!}/{!!$data['id']!!}"><i
                        class="las la-trash"></i>{!!__('Delete')!!}</button>

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
            {!!form()->vertical_open()
            ->id('app-form-show')
            ->class('app-form-show')
            ->method('PUT')
            ->action(guard_url('notification/notification'. $data['id']))!!}

            @php
            $data = form_merge_form($form['fields'], compact('data', 'meta'), true);
            $form = $data['form'];
            $mode = 'show';
            @endphp

            @include('notification::notification.partials.form')

            {!!form()->close()!!}
        </div>

            @include('notification::notification.partials.aside')
        </div>
    </div>

</div>
@else
<div class="app-entry-form-wrap" style="height:auto;">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <a href="#" class="mobile-back-btn"><i class="las la-arrow-left"></i></a>
        <i class="las la-list app-sec-title-icon"></i>
        <h2>{!!__('New')!!}</h2>
    </div>
</div>
<div class="app-detail-empty">
    <div class="empty-content">
        <img src="{!!theme_asset('img/empty-select.png')!!}" class="img-fluid" alt="">
        <h3>Select an item to view details</h3>
        <p>Nothing is selected</p>
    </div>
</div>
@endif