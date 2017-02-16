<div class="comment">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-8 title-main">
                                <i class="pe-7s-display2"></i>
                                <h4 class="title">{!! trans('workflow::workflow.title.user') !!}</h4>
                                <p class="sub-title">{!! trans('workflow::workflow.title.sub.user') !!}</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-form">
                                    {!!Form::open()
                                   ->method('GET')
                                   ->class('form pn')
                                   ->action(trans_url(get_guard('url').'/workflow/workflow'))!!}
                                    <div class="form-group form-white mn">
                                      {!!Form::text('search')->type('text')->placeholder('Search')->raw()!!}
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-round btn-white btn-raised search-btn"><i class="fa fa-search"></i></button>
                                    {!! Form::close()!!}
                                    <a href="{!!trans_url(get_guard('url').'/workflow/workflow/create')!!}" rel="tooltip" class="btn btn-white btn-round btn-simple btn-icon pull-right add-new" data-original-title="" title="">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="comment table-responsive table-full-width">
                        @include('public::notifications')
                        <table class="table table-bigboy">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th>{!! trans('workflow::workflow.label.workflowable_id')!!}</th>
                    <th>{!! trans('workflow::workflow.label.workflowable_type')!!}</th>
                    <th>{!! trans('workflow::workflow.label.action')!!}</th>
                    <th>{!! trans('workflow::workflow.label.status')!!}</th>
                    <th>{!! trans('workflow::workflow.label.performable_id')!!}</th>
                    <th>{!! trans('workflow::workflow.label.performable_type')!!}</th>
                    <th>{!! trans('workflow::workflow.label.status')!!}</th>
                    <th>{!! trans('workflow::workflow.label.created_at')!!}</th>
                    <th>{!! trans('workflow::workflow.label.updated_at')!!}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($workflows as $workflow)
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <a href="{{trans_url('workflow')}}/{{$workflow->getPublickey()}}">
                                              <img alt="" class="img-responsive" src="{!!url($workflow->defaultImage('sm','images'))!!}">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $workflow->workflowable_id }}</td>
                    <td>{{ $workflow->workflowable_type }}</td>
                    <td>{{ $workflow->action }}</td>
                    <td>{{ $workflow->status }}</td>
                    <td>{{ $workflow->performable_id }}</td>
                    <td>{{ $workflow->performable_type }}</td>
                                    <td class="td-actions">
                                        <a href="{{trans_url('workflow')}}/{!!$workflow->getRouteKey()!!}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Workflow" class="btn btn-info btn-simple">
                                            <i class="material-icons">panorama</i>
                                        </a>
                                        <a href="{!! trans_url(get_guard('url').'/workflow/workflow') !!}/{!! $workflow->getRouteKey() !!}/edit" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit Workflow" class="btn btn-success btn-simple">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Remove Workflow" class="btn btn-danger btn-simple" data-action="DELETE" data-href="{!! trans_url(get_guard('url').'/workflow/workflow') !!}/{!! $workflow->getRouteKey() !!}" data-remove="{!! $workflow->getRouteKey() !!}">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td><h4>No workflows found.</h4></td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        {{$workflows->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>