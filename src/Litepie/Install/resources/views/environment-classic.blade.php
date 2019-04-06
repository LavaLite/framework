@extends('install::layouts.master')

@section('template_title')
    {{ trans('install::messages.environment.classic.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('install::messages.environment.classic.title') }}
@endsection

@section('container')

    <form method="post" action="{{ route('LaravelInstaller::environmentSaveClassic') }}">
        {!! csrf_field() !!}
        <textarea class="textarea" name="envConfig">{{ $envConfig }}</textarea>
        <div class="buttons buttons--right">
            <button class="button button--light" type="submit">
            	<i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>
             	{!! trans('install::messages.environment.classic.save') !!}
            </button>
        </div>
    </form>

    @if( ! isset($environment['errors']))
        <div class="buttons-container">
            <a class="button float-left" href="{{ route('LaravelInstaller::environmentWizard') }}">
                <i class="fa fa-sliders fa-fw" aria-hidden="true"></i>
                {!! trans('install::messages.environment.classic.back') !!}
            </a>
            <a class="button float-right" href="{{ route('LaravelInstaller::database') }}">
                <i class="far fa-check-circle fa-fw" aria-hidden="true"></i>
                {!! trans('install::messages.environment.classic.install') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection