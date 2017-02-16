<div class="btn-group">
    <button type="button" class="btn btn-primary btn-sm dropdown-toggle btn-workflow" data-toggle="dropdown" aria-expanded="true"><i class="fa"></i> Actions</button>
    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <?php
            $icon = ['complete' => 'fa fa-check-circle text-orange','verify' => 'fa fa-check-circle text-olive','approve' => 'fa fa-check-circle text-aqua', 'publish' => 'fa fa-check-circle text-purple', 'unpublish' => 'fa fa-times-circle text-maroon', 'archive' => 'fa fa-file-archive-o text-navy', 'cancel' => 'fa fa-ban text-danger'];
        ?>
        @foreach($news->workflow['steps'] as $key => $value)

            @if($news->hasStep($key) && $news->canDo($key))
                @if($news->addInfo($key))
                    <li><a href="#" data-toggle="modal" data-target="#popupComment{{$key}}" ><i class="{{@$icon[$key]}} "></i> {{$key}}</a></li>
                    <div class="modal fade" id="popupComment{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md ">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #dd4b39;color: #fff;">
                                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                                    <h3 class="modal-title">{{$key}}</h3>
                                </div>
                                <div class="modal-body" id="{{$key}}">
                                    <?php
                                        $view = $news->workflow['steps'][$key]['addlinfo'];
                                    ?>
                                    @if(!strpos( $view, '::' ))
                                        @include('workflow::admin.workflow.'.$view)
                                    @else
                                        @include($view)
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btn-{{$key}}" class="btn btn-primary" data-view='{{$key}}' data-action='WORKFLOW' data-method="put" data-load-to='#news-news-entry' data-datatable='#news-news-list' data-href="{{trans_url('admin/news/news/workflow/'. $news->getRouteKey() .'/'.$key)}}"><i class="fa fa-check-circle"></i> Submit</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                                </div>

                            </div>          
                        </div>
                    </div>
                @else
                    <li><a id="btn-{{$key}}" data-action='WORKFLOW' data-method="PUT" data-load-to='#news-news-entry' data-href="{{trans_url('admin/news/news/workflow/'. $news->getRouteKey() .'/'.$key)}}" data-datatable='#news-news-list' href="#"><i class="{{@$icon[$key]}}"></i> {{$key}}</a></li>
                @endif
            @endif

        @endforeach    

        <li><a data-toggle="modal" data-target="#popupHistory" href="#"><i class="fa fa-history"></i> History</a></li>
    </ul>
</div>

<div class="modal fade" id="popupHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39;color: #fff;">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h3 class="modal-title">History</h3>
            </div>
            <div class="modal-body">
                <?php
                  $workflows    = @$news->workflowHistory;
                  $revisions    = @$news->revisionHistory;
                ?>
                @include('workflow::admin.workflow.flows')
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>

        </div>          
    </div>
</div>

<script type="text/javascript">
    
    $('.dropdown-menu li a').click(function(e) {
        
        if ($(e.target).is('[data-toggle=modal]')) {
            e.stopPropagation();
            $($(e.target).data('target')).modal()
        }
    });

</script>