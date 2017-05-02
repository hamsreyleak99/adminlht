@extends('layouts.app')

@section('header')
    <section class="content-header">
      <h1>Dashboard
        <small>The first page you see after login</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('') }}">{{ config('app.name') }}</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('login_status') }}</div>
                </div>
                <div class="box-body">{{ trans('logged_in') }} Hello welcome to laravel </div>
            </div>
        </div>
    </div>
@endsection
