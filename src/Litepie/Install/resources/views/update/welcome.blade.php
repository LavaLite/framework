@extends('install::layouts.master-update')

@section('title', trans('install::messages.updater.welcome.title'))
@section('container')
    <p class="paragraph text-center">
    	{{ trans('install::messages.updater.welcome.message') }}
    </p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::overview') }}" class="button">{{ trans('install::messages.next') }}</a>
    </div>
@stop
