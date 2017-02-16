<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-8 title-main">
                                <i class="pe-7s-display2"></i>
                                <h4 class="title">Revision</h4>
                                <p class="sub-title">List of Revisions</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-form">
                                    {!!Form::open()
                                   ->method('GET')
                                   ->class('form pn')
                                   ->action(trans_url($guard.'/revision/revision'))!!}
                                    <div class="form-group form-white mn">
                                      {!!Form::text('search')->type('text')->placeholder('Search')->raw()!!}
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-round btn-white btn-raised search-btn"><i class="fa fa-search"></i></button>
                                    {!! Form::close()!!}
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        @include('public::notifications')
                        <table class="table table-bigboy">
                            <thead>
                                <tr>
                                    <th width="20%">Field</th>
                                    <th width="20%">Module</th>
                                    <th width="15%">user</th>
                                    <th width="15%">Values</th>
                                    <th width="30%">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($revision as $content)
                                <tr>
                                    <td>
                                        {{@$content['field']}}
                                    </td>
                                    <td>
                                        {{substr(strrchr(@$content['revision_type'], '\\'), 1)}}
                                    </td>
                                    <td>
                                        {{@$content['user']['name']}}
                                    </td>
                                    <td >
                                        <a href="#valueModal{{$content['id']}}" data-toggle="modal" class="text-danger"><i class="pe-7s-note2 pe-2x"></i></a>
                                        <div class="modal fade" id="valueModal{{$content['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close btn btn-danger btn-simple" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                                        <h3 class="modal-title">Revision Values</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class='col-md-12'>
                                                            {!! Form::textarea('old_value')
                                                            -> label('Old Value')
                                                            -> placeholder('Enter old value')
                                                            -> forceValue(@$content['old_value'])
                                                            -> disabled()!!}
                                                        </div>
                                                        <div class='col-md-12'>
                                                            {!! Form::textarea('new_value')
                                                            -> label('New Value')
                                                            -> placeholder('Enter new value')
                                                            -> forceValue(@$content['new_value'])
                                                            -> disabled()!!}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                    <td><span class="word-inline">{{format_date_time($content['created_at'])}}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><h4>No Revision Found</h4></td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        {{$revision->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
.word-inline {
    white-space: nowrap;
    overflow-y: auto;
}
</style>