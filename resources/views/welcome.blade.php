@extends('layouts.app')

@section('content')
<div class="p-5 mb-4 bg-light border rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">{{__('app.greeting')}}</h1>
        <p class="col-md-8 fs-4">{{__('app.description')}}</p>
        <a href="https://hexlet.io" class="btn btn-primary btn-lg" type="button">{{__('app.link')}}</a>
    </div>
</div>
@endsection