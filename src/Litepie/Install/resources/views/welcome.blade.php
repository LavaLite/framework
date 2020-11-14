@extends('install::layouts.master')

@section('template_title')
    {{ trans('install::messages.welcome.templateTitle') }}
@endsection

@section('title')
    {{ trans('install::messages.welcome.title') }}
@endsection

@section('container')
    <p class="text-center">
      {{ trans('install::messages.welcome.message') }}
    </p>
    <p class="text-center">
      <a href="{{ route('LaravelInstaller::requirements') }}" class="button">
        {{ trans('install::messages.welcome.next') }}
        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
      </a>
    </p>
@endsection
