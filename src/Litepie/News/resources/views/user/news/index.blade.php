<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-8 title-main">
                                <i class="pe-7s-display2"></i>
                                <h4 class="title">News</h4>
                                <p class="sub-title">List of News  created by</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-form">
                                    {!!Form::open()
                                   ->method('GET')
                                   ->class('form pn')
                                   ->action(URL::to($guard.'/news/news'))!!}
                                    <div class="form-group form-white mn">
                                      {!!Form::text('search')->type('text')->placeholder('Search')->raw()!!}
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-round btn-white btn-raised search-btn"><i class="fa fa-search"></i></button>
                                    {!! Form::close()!!}
                                    <a href="{{trans_url($guard.'/news/news/create')}}" rel="tooltip" class="btn btn-white btn-round btn-simple btn-icon pull-right add-new" data-original-title="" title="">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        @include('public::notifications')
                        <table class="table table-bigboy">
                            <thead>
                                <tr>
                                    <th class="text-center">Thumb</th>
                                    <th>News Title</th>
                                    <th class="th-description">Description</th>
                                    <th class="text-right">Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($news as $content)
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <a href="{{trans_url('news')}}/{{@$content['slug']}}">
                                              <img alt="" class="img-responsive" src="{!!url($content->defaultImage('news.sm','images'))!!}">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="td-name">
                                        {{$content['title']}}
                                    </td>
                                    <td>
                                        {{strip_tags(substr($content['description'],0,100))}}
                                    </td>
                                    <td class="td-number">{{format_date($content['created_at'])}}</td>
                                    <td class="td-actions">
                                        <a href="{{trans_url('news')}}/{{@$content['slug']}}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Post" class="btn btn-info btn-simple">
                                            <i class="material-icons">panorama</i>
                                        </a>
                                        <a href="{{ trans_url($guard.'/news/news') }}/{!! $content->getRouteKey() !!}/edit" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit Post" class="btn btn-success btn-simple">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Remove Post" class="btn btn-danger btn-simple" data-action="DELETE" data-href="{!! trans_url($guard.'/news/news') !!}/{!! $content->getRouteKey() !!}" data-remove="{!! $content->getRouteKey() !!}">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td><h4>No News Found</h4></td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        {{$news->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>