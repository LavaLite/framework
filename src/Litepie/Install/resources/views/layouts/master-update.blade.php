
    <body>
        <div class="master">
            <div class="box">
                <div class="header">
                    <h1 class="header__title">@yield('title')</h1>
                </div>
                <ul class="step">
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelUpdater::final') }}">
                        <i class="step__icon fa fa-database" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelUpdater::overview') }}">
                        <i class="step__icon fa fa-reorder" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelUpdater::welcome') }}">
                        <i class="step__icon fa fa-refresh" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                </ul>
                <div class="main">
                    @yield('container')
                </div>
            </div>
        </div>
    </body>