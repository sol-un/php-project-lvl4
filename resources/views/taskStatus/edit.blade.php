@extends('layouts.app')

@section('content')

<h1 class="mb-5">{{__('taskStatus.editTaskStatus')}}</h1>

{{ Form::model($taskStatus, ['url' => route('taskStatuses.update', $taskStatus), 'method' => 'PATCH', 'class' => 'w-50']) }}

@include('taskStatus.form')
{{ Form::submit(__('taskStatus.edit'), ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

@endsection