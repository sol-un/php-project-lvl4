@extends('layouts.app')

@section('content')

<h1 class="mb-5">{{__('taskStatus.editTaskStatus')}}</h1>

{{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'PATCH', 'class' => 'w-50']) }}

@include('taskStatus.form')
{{ Form::submit(__('taskStatus.update'), ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

@endsection