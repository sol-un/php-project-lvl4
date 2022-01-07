@extends('layouts.app')

@section('content')

<h1 class="mb-5">{{__('label.create')}}</h1>

{{ Form::model($label, ['url' => route('labels.store'), 'class' => 'w-50']) }}

@include('label.form')
{{ Form::submit(__('label.create'), ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

@endsection