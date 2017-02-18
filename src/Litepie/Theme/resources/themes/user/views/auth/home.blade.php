<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="lavalite-info-tile blue">
                <a href="{!!url(getenv('auth.guard').'/message/message')!!}">
                    <div class="tile-heading clearfix">
                        <span class="title">Messages</span>
                    </div>
                    <div class="tile-body clearfix">
                        <span class="text"><sup></sup>{!!@Message::count('web')!!}</span>
                      <span class="icon"><i class="pe-7s-mail"></i></span>
                    </div>                
                    <hr>
                    <div class="tile-footer clearfix">
                         <span class="text-small">Go to messages</span>
                    </div>
                </a>
            </div>
        </div>       
        <div class="col-sm-6 col-md-3">
            <div class="lavalite-info-tile green">
                <a href="{!!url(getenv('auth.guard').'/task/task')!!}">
                    <div class="tile-heading clearfix">
                        <span class="title">Task</span>
                    </div>
                    <div class="tile-body clearfix">
                        <span class="text"><sup></sup>{!!Task::count(getenv('guard'))!!}</span>
                        <span class="icon"><i class="pe-7s-id"></i></span>
                    </div>                
                    <hr>
                    <div class="tile-footer clearfix">
                        <span class="text-small">Go to task</span>
                    </div>
                 </a>   
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="lavalite-info-tile red">
                <a href="{!!url(getenv('auth.guard').'/calendar/calendar')!!}">
                    <div class="tile-heading clearfix">
                        <span class="title">Events</span>
                    </div>
                    <div class="tile-body clearfix">
                        <span class="text"><sup></sup>{!!Calendar::count(getenv('guard'))!!}</span>
                        <span class="icon"><i class="pe-7s-date"></i></span>
                    </div>
                
                    <hr>
                    <div class="tile-footer clearfix">
                        <span class="text-small">Go to calendar</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="lavalite-info-tile purple">
                <a href="{!!url(getenv('auth.guard').'/news/news')!!}">
                    <div class="tile-heading clearfix">
                        <span class="title">News</span>
                    </div>
                    <div class="tile-body clearfix">
                       <span class="text"><sup></sup>{!!News::count(getenv('guard'))!!}</span>
                       <span class="icon"><i class="pe-7s-news-paper"></i></span>
                    </div>
                </a>
                <hr>
                  
                <div class="tile-footer clearfix">
                    <a href="{!!url(getenv('auth.guard').'/news/news')!!}"><span class="text-small">Go to news</span></a>
                    <a href="{!!url(getenv('auth.guard').'/news/news/create')!!}"><span class="add-icon"><i class="pe-7s-plus"></i></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="body card card-calendar mn pn">
                    {!!Calendar::gadget('user.calendar.gadget')!!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {!!Revision::activity()!!}
        </div>
        <div class="col-md-4">
            <div class="panel panel-default alt with-footer">
                <div class="heading clearfix">
                    <h2 class="title"><i class="ion-android-done"></i>Todo List</h2>
                    <div class="ctrls">
                        <div class="label label-primary">Pending</div>
                    </div>
                </div>
                <div class="body pn" style="max-height: 235px;overflow-x: auto;">
                    <ul class="media-list scroll-content m-n">
                                    <li class="media b-bl">
                                        <div class="media-content">
                                            <div class="media-left">
                                                <span class="input checkbox">
                                                    <label for="dashcheckbox1">
                                                        <input type="checkbox" name="ham" value="1" id="dashcheckbox1"/>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text">Create invoice mockup psd and convert to HTML/CSS</span> 
                                                <span class="info text-muted">assigned to Patrick Kim</span> 
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media b-bl">
                                        <div class="media-content">
                                            <div class="media-left">
                                                <span class="input checkbox">
                                                    <label for="dashcheckbox2">
                                                        <input type="checkbox" name="ham" value="1" id="dashcheckbox2"/>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text">Add animation to interface elements and custom dropdowns</span>
                                                <span class="info text-muted">assigned to Patrick Kim</span> 
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media b-bl">
                                        <div class="media-content">
                                            <div class="media-left">
                                                <span class="input checkbox">
                                                    <label for="dashcheckbox3">
                                                       <input type="checkbox" name="ham" value="1" id="dashcheckbox3"/> 
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text">Create invoice mockup psd and convert to HTML/CSS</span> 
                                                <span class="info text-muted">assigned to Patrick Kim</span> 
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media b-bl">
                                        <div class="media-content">
                                            <div class="media-left">
                                                <span class="input checkbox">
                                                    <label for="dashcheckbox4">
                                                        <input type="checkbox" name="ham" value="1" id="dashcheckbox4"/>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text">Create invoice mockup psd and convert to HTML/CSS</span> 
                                                <span class="info text-muted">assigned to Patrick Kim</span> 
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media b-bl">
                                        <div class="media-content">
                                            <div class="media-left">
                                                <span class="input checkbox">
                                                    <label for="dashcheckbox5">
                                                        <input type="checkbox" name="ham" value="1" id="dashcheckbox5" checked/>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text text-muted"><strike><em>Fix a bunch of angular bugs</em></strike></span> 
                                                <span class="info text-muted"><strike><em>assigned to Patrick Kim</em></strike></span> 
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media b-bl">
                                        <div class="media-content">
                                            <div class="media-left">
                                                <span class="input checkbox">
                                                    <label for="dashcheckbox6">
                                                        <input type="checkbox" name="ham" value="1" id="dashcheckbox6" checked/>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text text-muted"><strike><em>Fix a bunch of angular bugs</em></strike></span> 
                                                <span class="info text-muted"><strike><em>assigned to Patrick Kim</em></strike></span> 
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-content">
                                            <div class="media-left">
                                                <span class="input checkbox">
                                                    <label for="dashcheckbox7">
                                                        <input type="checkbox" name="ham" value="1" id="dashcheckbox7" checked/>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <span class="text text-muted"><strike><em>Fix a bunch of angular bugs</em></strike></span> 
                                                <span class="info text-muted"><strike><em>assigned to Patrick Kim</em></strike></span> 
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                </div>
                <div class="footer">
                    <a href="{!!url(getenv('auth.guard').'/task/task')!!}" class="btn btn-success btn-raised btn-sm">Add New</a>
                </div>
            </div>
        </div>
    </div>     
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="heading clearfix">
                    <h2 class="title alt">Countries<small>Map of the world with the population by country</small></h2>
                    <div class="ctrls">
                        <span class="icon"><i class="ion-android-sync"></i></span>
                        <span class="icon"><i class="ion-printer"></i></span>
                        <span class="icon"><i class="ion-settings"></i></span>
                    </div>
                </div>
                <div class="panel-editbox" data-widget-controls=""></div>
                <div class="body world">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="map">
                                <div class="areaLegend">
                                </div>
                                <div class="plotLegend">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <h4 class="mt-n">Population</h4>
                            <table class="table population mb-md">
                                <tbody>
                                    <tr>
                                        <td style="width: 60%">Tokyo</td>
                                        <td class="text-right" style="width: 25%"><strong>1,491,797</strong></td>
                                        <td class="text-right" style="width: 15%"><span class="icon success"><i class="text-success ion-android-arrow-up"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 60%">New York</td>
                                        <td class="text-right" style="width: 25%"><strong>881,903</strong></td>
                                        <td class="text-right" style="width: 15%"><span class="icon success"><i class="text-success ion-android-arrow-up"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 60%">Sydney</td>
                                        <td class="text-right" style="width: 25%"><strong>695,496</strong></td>
                                        <td class="text-right" style="width: 15%"><span class="icon danger"><i class="text-danger ion-android-arrow-down"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 60%">Brasilia</td>
                                        <td class="text-right" style="width: 25%"><strong>392,706</strong></td>
                                        <td class="text-right" style="width: 15%"><span class="icon success"><i class="text-success ion-android-arrow-up"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 60%">Paris</td>
                                        <td class="text-right" style="width: 25%"><strong>382,495</strong></td>
                                        <td class="text-right" style="width: 15%"><span class="icon danger"><i class="text-danger ion-android-arrow-down"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 60%">London</td>
                                        <td class="text-right" style="width: 25%"><strong>285,406</strong></td>
                                        <td class="text-right" style="width: 15%"><span class="icon danger"><i class="text-danger ion-android-arrow-down"></i></span></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="list-unstyled mn">
                                        <li><span class="round list-2"></span>less than 50,000</li>
                                        <li><span class="round list-4"></span>less than 100,000</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-unstyled mn">
                                        <li><span class="round list-6"></span>less than 200,000</li>
                                        <li><span class="round list-8"></span>less than 250,000</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-unstyled mn">
                                        <li><span class="round list-10"></span>less than 300,000</li>
                                        <li><span class="round list-12"></span>more than 400,000</li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="text-small mb-n text-light text-left">Asperiores in eveniet sapiente error fuga tenetur ex ea dignissimos voluptas ab molestiae eos totam quo dolorem maxime illo neque quia itaque</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default alt list-countries">
                <div class="heading mn">
                    <ul class="nav nav-tabs tab-warning material-nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#dashtab-7-2" aria-expanded="true">Top Item Sales</a></li>
                        <li class=""><a data-toggle="tab" href="#dashtab-7-3" aria-expanded="false">Top Visitor</a></li>
                    </ul>
                </div>
                <div class="body tab-container pn mn">
                    <div class="tab-content pn">
                        <div id="dashtab-7-2" class="tab-pane active">
                            <div class="list clearfix">
                                <div class="lists">
                                    <span class="progresss" style="width: 70%"></span>
                                    <span class="text-left country">United States</span>
                                    <span class="text-right visitor">$44,700.50</span>
                                </div>
                                <div class="lists">
                                    <span class="progresss" style="width: 50%"></span>
                                    <span class="text-left country">Brazil</span>
                                    <span class="text-right visitor">$15,100.24</span>
                                </div>
                                <div class="lists">
                                    <span class="progresss" style="width: 45%"></span>
                                    <span class="text-left country">Belgium</span>
                                    <span class="text-right visitor">$14,330.91</span>
                                </div>
                                <div class="lists">
                                    <span class="progresss" style="width: 40%"></span>
                                    <span class="text-left country">United Kingdom</span>
                                    <span class="text-right visitor">$8,009.70</span>
                                </div>
                                <div class="lists">
                                    <span class="progresss" style="width: 38%"></span>
                                    <span class="text-left country">France</span>
                                    <span class="text-right visitor">$6,890.11</span>
                                </div>
                                <div class="lists">
                                    <span class="progresss" style="width: 34%"></span>
                                    <span class="text-left country">India</span>
                                    <span class="text-right visitor">$5,200.43</span>
                                </div>
                                <div class="lists">
                                    <span class="progresss" style="width: 26%"></span>
                                    <span class="text-left country">Germany</span>
                                    <span class="text-right visitor">$4,180.22</span>
                                </div>
                                <div class="lists">
                                    <span class="progresss" style="width: 20%"></span>
                                    <span class="text-left country">Spain</span>
                                    <span class="text-right visitor">$3,950.66</span>
                                </div>
                            </div>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>