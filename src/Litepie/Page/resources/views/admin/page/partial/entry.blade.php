            <div class="tab-pane disabled active row" id="details">

                <div class="col-md-12 col-lg-12">
                {!! Form::text('name')
                -> label(trans(trans('page::page.label.name')))
                -> placeholder(trans(trans('page::page.placeholder.name')))
                !!}

                {!! Form::textarea('content')
                -> label(trans('page::page.label.content'))
                -> value(e($page['content']))
                -> dataUpload(trans_url($page->getUploadURL('content')))
                -> addClass('html-editor')
                -> placeholder(trans('page::page.placeholder.content'))
                !!}
                </div>
            </div>
            <div class="tab-pane disabled row" id="metatags">
                <div class="col-md-6 col-lg-6">
                    {!! Form::text('meta_title')
                    -> label(trans('page::page.label.meta_title'))
                    -> placeholder(trans('page::page.placeholder.meta_title'))
                    !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::text('heading')
                    -> label(trans('page::page.label.heading'))
                    -> placeholder(trans('page::page.placeholder.heading'))
                    !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::textarea('meta_keyword')
                    -> label(trans('page::page.label.meta_keyword'))
                    -> rows(4)
                    -> placeholder(trans('page::page.placeholder.meta_keyword'))
                    !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::textarea('meta_description')
                    -> label(trans('page::page.label.meta_description'))
                    -> rows(4)
                    -> placeholder(trans('page::page.placeholder.meta_description'))
                    !!}
                </div>
            </div>
            <div class="tab-pane disabled row" id="settings">
                <div class="col-md-6 ">
                    {!! Form::range('order')
                    -> label(trans('page::page.label.order'))
                    -> placeholder(trans('page::page.placeholder.order'))
                    !!}

                    {!! Form::text('slug')
                    -> label(trans('page::page.label.slug'))
                    -> append('.html')
                    -> placeholder(trans('page::page.placeholder.slug'))
                    !!}

                    {!! Form::select('view')
                    -> options(trans('page::page.options.view'))
                    -> label(trans('page::page.label.view'))
                    -> placeholder(trans('page::page.placeholder.view'))
                    !!}
                </div>
                <div class='col-md-6'>
                    {!! Form::select('compiler')
                    -> options(trans('page::page.options.compiler'))
                    -> label(trans('page::page.label.compiler'))
                    -> placeholder(trans('page::page.placeholder.compiler'))
                    !!}

                    {!! Form::select('category_id')
                    -> options([])
                    -> label(trans('page::page.label.category_id'))
                    -> placeholder(trans('page::page.placeholder.category_id'))
                    !!}
                    {!! Form::hidden('status')
                    -> forceValue('0')
                    !!}

                    {!! Form::checkbox('status')
                    -> label(trans('page::page.label.status'))
                    -> inline()
                    !!}
                </div>
            </div>
          