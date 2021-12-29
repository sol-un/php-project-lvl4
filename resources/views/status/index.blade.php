@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('status.statuses')}}</h1>
@auth
<a href="{{ route('statuses.create') }}" class="btn btn-primary">
  {{__('status.create')}}
</a>
@endauth
<table class="table mt-2">
  <thead>
    <tr>
      <th>{{__('status.id')}}</th>
      <th>{{__('status.name')}}</th>
      <th>{{__('status.created_at')}}</th>
      @auth
      <th>{{__('status.actions')}}</th>
      @endauth
    </tr>
  </thead>
  @foreach($statuses as $status)
  <tr>
    <td>{{ $status->id }}</td>
    <td>{{ $status->name }}</td>
    <td>{{ $status->created_at }}</td>
    @auth
    <td>
      <a class="text-danger text-decoration-none" href="{{ route('statuses.destroy', $status) }}" data-confirm="Вы уверены?" data-method="delete">
        {{__('status.delete')}}
      </a>
      <a class="text-decoration-none" href="{{ route('statuses.edit', $status) }}">
        {{__('status.edit')}}
      </a>
    </td>
    @endauth
  </tr>
  @endforeach
</table>
@endsection
