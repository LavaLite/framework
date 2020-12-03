<div class='row'>
    <div class='col-md-6 col-sm-12'>
        {!! Form::text('name')
        -> label(trans('master::master.label.name'))
        -> placeholder(trans('master::master.placeholder.name'))!!}
    </div>
    <div class='col-md-6 col-sm-12'>
        {!! Form::select('status')
        -> label(trans('master::master.label.status'))
        -> options(trans('master::master.options.status'))
        -> placeholder(trans('master::master.placeholder.status'))!!}
    </div>
    @if(in_array('icon', config("master.masters.$type.fields", [])))
    <div class='col-md-6 col-sm-12'>
        {!! Form::text('icon')
        -> label(trans('master::master.label.icon'))
        -> placeholder(trans('master::master.placeholder.icon'))!!}
    </div>
    @endif
    @if(in_array('amount', config("master.masters.$type.fields", [])))
    <div class='col-md-6 col-sm-12'>
        {!! Form::text('amount')
        -> label(trans('master::master.label.amount'))
        -> placeholder(trans('master::master.placeholder.amount'))!!}
    </div>
    @endif
    @if(in_array('parent_id', config("master.masters.$type.fields", [])))
    <div class='col-md-6 col-sm-12'>
        {!! Form::select('parent_id')
        -> label(trans('master::master.label.parent_id'))
        -> options([ 0 => 'Root'] + $parents)
        -> placeholder(trans('master::master.placeholder.parent_id'))!!}
    </div>
    @endif
    <div class='col-md-12 col-sm-12'>
        {!! Form::textarea('description')
        -> label(trans('master::master.label.description'))
        -> placeholder(trans('master::master.placeholder.description'))!!}
    </div>
    <div class='col-md-12 col-sm-12'>
        @if ($mode == 'create')
        <div class="form-group">
            <label for="image" class="control-label text-left">
                {{trans('master::master.label.image') }}
            </label>
            <div>
                {!! $master->files('image')
                ->url($master->getUploadUrl('image'))
                ->uploader()!!}
            </div>
        </div>
        @elseif ($mode == 'edit')
        <div class="form-group">
            <label for="image" class="control-label text-left">
                {{trans('master::master.label.image') }}
            </label>
            <div>
                {!! $master->files('image')
                ->url($master->getUploadUrl('image'))
                ->uploader()!!}
            </div>
            <div>
                {!! $master->files('image')
                ->url($master->getUploadUrl('image'))
                ->editor()!!}
            </div>
        </div>
        @elseif ($mode == 'show')
        <div class="form-group">
            <label for="image" class="control-label text-left">
                {{trans('master::master.label.image') }}
            </label>
            <div>
                {!! $master->files('image') !!}
            </div>
        </div>
        @endif
    </div>
</div>
