        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a>{!! trans('master::master.names') !!}</a>
                </li>
                <li class="pull-right">
                    <span class="actions">
                    </span>
                </li>
            </ul>

            <div class="tab-content">
                <table id="masters-list" class="table table-striped data-table">
                    <thead class="list_head">
                        <th style="text-align: right;" width="1%"><a class="btn-reset-filter" href="#Reset"
                                style="display:none; color:#fff;"><i class="fa fa-filter"></i></a> <input
                                type="checkbox" id="masters-check-all"></th>
                        <th>{!! trans('master::master.label.name')!!}</th>
                        <th>{!! trans('master::master.label.slug')!!}</th>
                        <th>{!! trans('master::master.label.status')!!}</th>
                    </thead>
                </table>
            </div>
        </div>
