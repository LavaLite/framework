
<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="las la-stream app-sec-title-icon"></i>
        <h2>Masters</h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" 
            data-action="CREATE" 
            data-load-to="#master-entry"
            data-url="{{guard_url('master/create')}}?type={{$type}}"
            >
                <i class="las la-save"></i>New
            </button>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
        
            <div class="col-12">
                <div class="app-entry-form-section" id="master-entry">
                    <div class="section-title"> {{trans("master::master.masters.$type")}}</div>
                    <table class="table table-hover">
                        <thead>
                            <th>{!! trans('master::master.label.name')!!}</th>
                            <th>{!! trans('master::master.label.slug')!!}</th>
                            <th>{!! trans('master::master.label.status')!!}</th>
                            <th>{!! trans('Action')!!}</th>
                        </thead>

                        <tbody>
                            <tr>
                            <td>{!! trans('master::master.label.name')!!}</td>
                            <td>{!! trans('master::master.label.slug')!!}</td>
                            <td>{!! trans('master::master.label.status')!!}</td>
                            <td>{!! trans('Action')!!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>