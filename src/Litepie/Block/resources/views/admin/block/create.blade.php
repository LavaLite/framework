<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">{!! trans('block::block.tab.name') !!}</a></li>
        <li><a href="#images" data-toggle="tab">Images</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#block-block-create'  data-load-to='#block-block-entry' data-datatable='#block-block-list'><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#block-block-entry' data-href='{{trans_url('admin/block/block/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('block-block-create')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/block/block'))!!}
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="details">
            <div class="tab-pan-title"> {{ trans('app.create') }}  {!! trans('block::block.name') !!} </div>
            @include('block::admin.block.partial.entry')
        </div>
        <div class="tab-pane" id="images">
            <div class="row">
                <div class="form-group">
                        <label for="images" class="control-label col-lg-12 col-sm-12 text-left">
                            {{trans('block::block.label.images') }}
                        </label>
                        <div class='col-lg-6 col-sm-12'>
                            {!! $block->fileUpload('images')!!}
                        </div>
                        <div class='col-lg-12 col-sm-12'>
                            {!! $block->fileEdit('images')!!}
                        </div>
                    </div>
                </div>
             </div>
       </div>
    {!! Form::close() !!}
</div>