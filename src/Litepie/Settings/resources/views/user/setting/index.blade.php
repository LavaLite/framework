<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-8 title-main">
                                <i class="pe-7s-display2"></i>
                                <h4 class="title">{!! trans('settings::setting.title.user') !!}</h4>
                                <p class="sub-title">{!! trans('settings::setting.title.sub.user') !!}</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-form">
                                    {!!Form::open()
                                   ->method('GET')
                                   ->class('form pn')
                                   ->action(guard_url('/settings/setting'))!!}
                                    <div class="form-group form-white mn">
                                      {!!Form::text('search')->type('text')->placeholder('Search')->raw()!!}
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-round btn-white btn-raised search-btn"><i class="fa fa-search"></i></button>
                                    {!! Form::close()!!}
                                    <a href="{!!guard_url('/settings/setting/create')!!}" rel="tooltip" class="btn btn-white btn-round btn-simple btn-icon pull-right add-new" data-original-title="" title="">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        @include('public::notifications')
                        <table class="table table-bigboy">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th>{!! trans('settings::setting.label.key')!!}</th>
                    <th>{!! trans('settings::setting.label.package')!!}</th>
                    <th>{!! trans('settings::setting.label.module')!!}</th>
                    <th>{!! trans('settings::setting.label.name')!!}</th>
                    <th>{!! trans('settings::setting.label.value')!!}</th>
                    <th>{!! trans('settings::setting.label.file')!!}</th>
                    <th>{!! trans('settings::setting.label.control')!!}</th>
                    <th>{!! trans('settings::setting.label.type')!!}</th>
                    <th>{!! trans('settings::setting.label.status')!!}</th>
                    <th>{!! trans('settings::setting.label.created_at')!!}</th>
                    <th>{!! trans('settings::setting.label.updated_at')!!}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($settings as $setting)
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <a href="{{trans_url('setting')}}/{{$setting->getPublickey()}}">
                                              <img alt="" class="img-responsive" src="{!!url($setting->defaultImage('sm','images'))!!}">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $setting->key }}</td>
                    <td>{{ $setting->package }}</td>
                    <td>{{ $setting->module }}</td>
                    <td>{{ $setting->name }}</td>
                    <td>{{ $setting->value }}</td>
                    <td>{{ $setting->file }}</td>
                    <td>{{ $setting->control }}</td>
                    <td>{{ $setting->type }}</td>
                                    <td class="td-actions">
                                        <a href="{{trans_url('setting')}}/{!!$setting->getRouteKey()!!}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Setting" class="btn btn-info btn-simple">
                                            <i class="material-icons">panorama</i>
                                        </a>
                                        <a href="{!! guard_url('/settings/setting') !!}/{!! $setting->getRouteKey() !!}/edit" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit Setting" class="btn btn-success btn-simple">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Remove Setting" class="btn btn-danger btn-simple" data-action="DELETE" data-href="{!! guard_url('/settings/setting') !!}/{!! $setting->getRouteKey() !!}" data-remove="{!! $setting->getRouteKey() !!}">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td><h4>No settings found.</h4></td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        {{$settings->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>