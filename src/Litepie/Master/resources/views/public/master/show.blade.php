            @include('master::public.master.partial.header')

            <section class="single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            @include('master::public.master.partial.aside')
                        </div>
                        <div class="col-md-9 ">
                            <div class="area">
                                <div class="item">
                                    <div class="feature">
                                        <img class="img-responsive center-block" src="{!!url($master->defaultImage('images' , 'xl'))!!}" alt="{{$master->title}}">
                                    </div>
                                    <div class="content">
                                        <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="id">
                    {!! trans('master::master.label.id') !!}
                </label><br />
                    {!! $master['id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="parent_id">
                    {!! trans('master::master.label.parent_id') !!}
                </label><br />
                    {!! $master['parent_id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="type">
                    {!! trans('master::master.label.type') !!}
                </label><br />
                    {!! $master['type'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="name">
                    {!! trans('master::master.label.name') !!}
                </label><br />
                    {!! $master['name'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="description">
                    {!! trans('master::master.label.description') !!}
                </label><br />
                    {!! $master['description'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="icon">
                    {!! trans('master::master.label.icon') !!}
                </label><br />
                    {!! $master['icon'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="image">
                    {!! trans('master::master.label.image') !!}
                </label><br />
                    {!! $master['image'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="slug">
                    {!! trans('master::master.label.slug') !!}
                </label><br />
                    {!! $master['slug'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="created_at">
                    {!! trans('master::master.label.created_at') !!}
                </label><br />
                    {!! $master['created_at'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="updated_at">
                    {!! trans('master::master.label.updated_at') !!}
                </label><br />
                    {!! $master['updated_at'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="deleted_at">
                    {!! trans('master::master.label.deleted_at') !!}
                </label><br />
                    {!! $master['deleted_at'] !!}
            </div>
        </div>
    </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::select('parent_id')
                    -> options(trans('master::master.options.parent_id'))
                    -> label(trans('master::master.label.parent_id'))
                    -> placeholder(trans('master::master.placeholder.parent_id'))!!}
               </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::select('type')
                    -> options(trans('master::master.options.type'))
                    -> label(trans('master::master.label.type'))
                    -> placeholder(trans('master::master.placeholder.type'))!!}
               </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('master::master.label.name'))
                       -> placeholder(trans('master::master.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::textarea ('description')
                    -> label(trans('master::master.label.description'))
                    -> placeholder(trans('master::master.placeholder.description'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('icon')
                       -> label(trans('master::master.label.icon'))
                       -> placeholder(trans('master::master.placeholder.icon'))!!}
                </div>

                <div class='col-md-12 col-sm-12'>
                    <div class="form-group">
                        <label for="image" class="control-label col-lg-12 col-sm-12 text-left"> {{trans('master::master.label.image') }}
                        </label>
                        <div class='col-lg-3 col-sm-12'>
                            {!! $master->files('image')
                            ->url($master->getUploadUrl('image'))
                            ->mime(config('filer.image_extensions'))
                            ->dropzone()!!}
                        </div>
                        <div class='col-lg-7 col-sm-12'>
                        {!! $master->files('image')
                        ->editor()!!}
                        </div>
                    </div>
                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



