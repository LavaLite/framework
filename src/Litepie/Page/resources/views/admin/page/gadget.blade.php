
<table class="table  table-condensed">
    <tr>
        <th>{{ Lang::get('page::page.name') }}</th>
        <th>{{ Lang::get('page::page.label.title') }}</th>
        <th>{{ Lang::get('page::page.label.slug') }}</th>
        <th width="70">{{ Lang::get('app.options') }}</th>
    </tr>

    @foreach ($pages as $page)
    <tr>
        <td><a href="{{ ($permissions['view']) ? (Trans::to('admin/page/page/') . '/' . $page->getRouteKey() ) : '#' }}">{{ $page->name }}</a></td>
        <td>{{ $page->title }}</td>
        <td>{{ $page->slug }}.html</td>
        <td>
            <div class="btn-group  btn-group-xs">
                <a type="button" class="btn btn-info  {{ ($permissions['edit']) ? '' : 'disabled' }} view-btn-edit" href="{{ Trans::to('admin/page/page')}}/{{$page->getRouteKey()}}/edit" title="{{ Lang::get('app.update') }} Page"><i class="fa fa-pencil-square-o"></i></a>
                <a type="button" class="btn btn-danger action_confirm  {{ ($permissions['delete']) ? '' : 'disabled' }} view-btn-delete" data-method="delete" href="{{ Trans::to('admin/page/page') }}/{{ $page->getRouteKey() }}" title="{{ Lang::get('app.delete') }} Page"><i class="fa fa-times-circle-o"></i></a>
            </div>
        </td>
    </tr>
    @endforeach

</table>