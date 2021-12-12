@extends('layouts.app')

@section('content')

<h1 class="mb-5">{{__('status.create')}}</h1>

{{ Form::model($status, ['url' => route('statuses.store'), 'class' => 'w-50']) }}

@include('status.form')
{{ Form::submit(__('status.create'), ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

@endsection