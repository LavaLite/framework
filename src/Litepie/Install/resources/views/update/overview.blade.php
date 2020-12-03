@extends('install::layouts.master-update')

@section('title', trans('install::messages.updater.welcome.title'))
@section('container')
    <p class="paragraph text-center">{{ trans_choice('install::messages.updater.overview.message', $numberOfUpdatesPending, ['number' => $numberOfUpdatesPending]) }}</p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::database') }}" class="button">{{ trans('install::messages.updater.overview.install_updates') }}</a>
    </div>
@stop
