<div class="app-list-wrap">
    <div class="app-list-inner">
        <div class="app-list-header d-flex align-items-center justify-content-between">
            <h3>{{__('Masters')}}</h3>
        </div>
        @include("master::menu")
    </div>
    <div class="app-detail-wrap" id="app-content">
        @include("master::list")
    </div>
</div>