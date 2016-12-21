        <div class="card-box">
            <h4 class="text-dark  header-title m-t-0"> Search </h4>
            {!!Form::vertical_open()
            ->action(trans_url('calendars'))
            ->method('GET')!!}
            <div class="input-group">
                {!!Form::text('search')->type('search')
                ->class('form-control')
                ->placeholder('Search for...')->raw()!!}
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Search</button>
                </span>
            </div>
            {!! Form::close()!!}
        </div>
