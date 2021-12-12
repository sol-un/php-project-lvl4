@extends('layouts.app')

@section('content')

<h1 class="mb-5">{{__('status.editStatus')}}</h1>

{{ Form::model($status, ['url' => route('statuses.update', $status), 'method' => 'PATCH', 'class' => 'w-50']) }}

@include('status.form')
{{ Form::submit(__('status.edit'), ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

@endsection