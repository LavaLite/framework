<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-danger">
                {!!Form::vertical_open()
                ->id('news-news-create')
                ->method('POST')
                ->files('true')
                ->action(trans_url('workflows/workflow/'.@$workflow->id))!!}
                <div class="panel-heading" style="background-color: #dd4b39;color: #fff;">
                    <h3 class="panel-title">{!!@$workflow->workflowable->title!!}</h3>
                </div>
                <div class="panel-body">
                    {!! Form::textarea('comment')
                    -> addClass('workflow_data')
                    -> required()!!}
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-check-circle"></i> {!!@$workflow->action!!}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
