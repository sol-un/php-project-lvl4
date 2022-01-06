@extends('layouts.app')

@section('content')

<h1 class="mb-5">{{__('taskStatus.create')}}</h1>

{{ Form::model($taskStatus, ['url' => route('taskStatuses.store'), 'class' => 'w-50']) }}

@include('taskStatus.form')
{{ Form::submit(__('taskStatus.create'), ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

@endsection