
<nav aria-label="breadcrumb" class="mt-20">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Masters</a></li>
    <li class="breadcrumb-item"><a href="#">Projects</a></li>
    <li class="breadcrumb-item active" aria-current="page">Project</li>
  </ol>
</nav>


<div class="tab-content">
    <table id="masters-list" class="table table-striped data-table">
        <thead class="list_head">
            <th style="text-align: right;" width="1%">#</th>
            <th>{!! trans('master::master.label.name')!!}</th>
            <th>{!! trans('master::master.label.code')!!}</th>
            <th>{!! trans('master::master.label.status')!!}</th>
            <th>{!! trans('app.actions')!!}</th>
        </thead>
        <tbody>
            @foreach($datas as $key => $data)
            <tr>
                <th scope="row">{{$key}}</th>
                <td>{{$data['name']}}</td>
                <td>{{$data['code']}}</td>
                <td>{{$data['status']}}</td>
                <td><a href="{{trans_url('master/')}}">E</a> <a href="#">D</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>