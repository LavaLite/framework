<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $message['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('messages') }}" class="btn btn-default pull-right"> Back</a>
                    </div>
                </div>
                <hr/>

                <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="status">
                    {!! trans('message::message.label.status') !!}
                </label><br />
                    {!! $message['status'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="star">
                    {!! trans('message::message.label.star') !!}
                </label><br />
                    {!! $message['star'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="from">
                    {!! trans('message::message.label.from') !!}
                </label><br />
                    {!! $message['from'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="to">
                    {!! trans('message::message.label.to') !!}
                </label><br />
                    {!! $message['to'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="subject">
                    {!! trans('message::message.label.subject') !!}
                </label><br />
                    {!! $message['subject'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="message">
                    {!! trans('message::message.label.message') !!}
                </label><br />
                    {!! $message['message'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="read">
                    {!! trans('message::message.label.read') !!}
                </label><br />
                    {!! $message['read'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="type">
                    {!! trans('message::message.label.type') !!}
                </label><br />
                    {!! $message['type'] !!}
            </div>
        </div>
    </div>
            </div>  
        </div>  
        <div class="col-md-4">
            @include('message::public.message.aside')
        </div>

    </div>
</div>