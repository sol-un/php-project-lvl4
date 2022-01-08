@extends('layouts.app')

@section('content')

<h1 class="mb-5">{{__('label.editLabel')}}</h1>

{{ Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'w-50']) }}

@include('label.form')
{{ Form::submit(__('label.update'), ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

@endsection